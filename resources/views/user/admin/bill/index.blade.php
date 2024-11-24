@php
    $tenement = Auth::user()->adminProfile->tenement;
@endphp
<x-dashboard.admin.base>


    <x-notification-message />

    <div class="panel p-2" style="overflow-x:auto;">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-primary">Billing Records</h1>
            <!-- You can open the modal using ID.showModal() method -->
            <div class="flex items-center gap-5">
                <a href="{{ route('admin.bills.payments.index') }}" class="btn btn-sm btn-accent text-primay">Payments
                    ({{ $totalPayments }})</a>
                <button class="btn btn-sm btn-primary text-accent" onclick="my_modal_3.showModal()">Generate Bills</button>
            </div>

        </div>

        <h1>
            List of Paid
        </h1>

        <div class="h-auto w-auto" x-data="billCreate" x-init="getTenementId({{ $tenement->id }})">
            <x-table-body :columns="[
                'Month',
                'Amount',
                'Tenant',
                'Unit No.',
                'Type',
                'Status',
                'Due Date',
                'Created By',
                'Date & Time',
            ]" label="">

                @forelse ($bills as $bill)
                    <tr>
                        <td>

                        </td>
                        <td>
                            {{ $bill->created_at->format('F') }}
                        </td>
                        <td>
                            ₱ {{ number_format($bill->amount) }}
                        </td>
                        <td >
                            {{ $bill->tenant->user->profile->last_name }},
                            {{ $bill->tenant->user->profile->first_name }}
                        </td>
                        <td>
                            {{ $bill->tenant->room->room_number }}
                        </td>
                        <td class="capitalize">
                            {{ $bill->type }}
                        </td>
                        <td class="capitalize">
                            {{ $bill->status }}
                        </td>
                        <td>
                            {{ date('F d, Y', strtotime($bill->due_date)) }}
                        </td>
                        <td>
                            {{ $bill->created_by }}
                        </td>
                        <td>
                            {{ $bill->created_at->format('F d, Y h:s A') }}
                        </td>

                        <td class="flex gap-2 justify-center">
                            <a href="{{ route('admin.bills.show', ['bill' => $bill->id]) }}"
                                class="btn btn-accent btn-sm text-primary">
                                View
                            </a>
                            {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                                <i class="fi fi-rr-edit"></i>
                            </a> --}}
                            {{-- <form action="{{ route('admin.bills.destroy', ['bill' => $bill->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-error btn-sm">
                                    <i class="fi fi-rr-trash"></i>
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <td>No bill</td>
                @endforelse
                <tr>
                    <td></td>
                </tr>

                {!! $bills->links() !!}
            </x-table-body>


            <dialog id="my_modal_3" class="modal">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                    </form>
                    <h3 class="text-lg font-bold text-primary">Generate Bills</h3>
                    <div class="panel p-2">
                        <form action="{{ route('admin.bills.createAll') }}" method="post"
                            class="w-full h-full flex flex-col gap-2">
                            @csrf
                            {{-- <div class="flex flex-col gap-2">
                                <h1 class="input-generic-label">name</h1>
                                <input type="text" name="name" class="input-generic">
                            </div>

                            @if ($errors->has('name'))
                                <p class="text-xs text-error">{{ $errors->first('name') }}</p>
                            @endif --}}
                            <div class="flex flex-col gap-2">
                                <h1 class="input-generic-label">Send Type</h1>
                                <select name="send_type" @click="selectSendType($event)"
                                    class="select select-primary w-full select-sm text-sm">
                                    <option disabled selected>Select Sent Type</option>

                                    <option value="all">Monthly Bills</option>
                                    <option value="specific">Advance Payment</option>

                                </select>
                            </div>

                            <template x-if="sendType === 'specific'">
                                <div class="flex flex-col gap-2">
                                    <div class="flex flex-col gap-2">
                                        <div class="flex items-center gap-2">
                                            <h1 class="input-generic-label">Tenant
                                            </h1>
                                            <span x-show="totalResult !== 0" class="flex items-center w-1/2">
                                                (<p x-text="totalResult"></p>)
                                            </span>
                                        </div>

                                        <input x-model.debounce.500ms="search" class="input-generic">
                                    </div>
                                    <template x-if="tenants.length !== 0">
                                        <select name="user_id" class="select select-primary w-full select-sm text-sm">
                                            <option> Result </option>
                                            <template x-for="tenant in tenants" :key="tenant.id">
                                                <option :value="tenant.id">
                                                    <span x-text="tenant.profile.last_name"></span>,
                                                    <span x-text="tenant.profile.first_name"></span>
                                                </option>
                                            </template>
                                        </select>
                                    </template>
                                    <div class="flex flex-col gap-2">
                                        <h1 class="input-generic-label">Month</h1>
                                        <input type="text" name="month" class="input-generic">
                                    </div>
                                </div>
                            </template>



                            <div class="flex flex-col gap-2">
                                <h1 class="input-generic-label">Amount</h1>
                                <input type="number" name="amount" class="input-generic">
                            </div>
                            @if ($errors->has('amount'))
                                <p class="text-xs text-error">{{ $errors->first('amount') }}</p>
                            @endif
                            <div class="flex flex-col gap-2" x-show="sendType === 'all'">
                                <h1 class="input-generic-label">Due Date</h1>
                                <input type="date" name="due_date" class="input-generic">
                            </div>

                            <div class="flex flex-col gap-2">
                                <h1 class="input-generic-label">Type</h1>
                                <select name="type"
                                    class="select select-primary w-full select-sm capitalize text-xs">
                                    <option :value="null">Select</option>
                                    <option value="monthly dues">Monthly Dues</option>
                                    <option value="monthly amortization"> Monthly
                                        Amortization</option>
                                    {{-- <option value="amilyar">amilyar</option> --}}
                                </select>
                                @if ($errors->has('type'))
                                    <p class="text-xs text-error">{{ $errors->first('type') }}</p>
                                @endif
                            </div>

                            <button class="btn btn-sm btn-primary text-accent">Submit</button>
                        </form>
                    </div>
            </dialog>

        </div>



        <h1>
            List of Unpaid
        </h1>

        <x-table-body :columns="['Month', 'Amount', 'Tenant', 'Unit No.', 'Type', 'Status', 'Due Date', 'Created By', 'Date & Time']" label="">

            @forelse ($unpaidBills as $bill)
                <tr>
                    <td>

                    </td>
                    <td>
                        {{ date('F', strtotime($bill->due_date)) }}
                    </td>
                    <td>
                        ₱ {{ number_format($bill->amount, 2) }}
                    </td>
                    <td>
                        {{ $bill->tenant->user->profile->last_name }}, {{ $bill->tenant->user->profile->first_name }}
                    </td>
                    <td>
                        {{ $bill->tenant->room->room_number }}
                    </td>
                    <td class="capitalize">
                        {{ $bill->type }}
                    </td>
                    <td class="capitalize">
                        {{ $bill->status }}
                    </td>
                    <td>
                        {{ date('F d, Y', strtotime($bill->due_date)) }}
                    </td>
                    <td>
                        {{ $bill->created_by }}
                    </td>
                    <td>
                        {{ $bill->created_at->format('F d, Y h:s A') }}
                    </td>

                    <td class="flex gap-2 justify-center">
                        <a href="{{ route('admin.bills.show', ['bill' => $bill->id]) }}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}


                        <button class="btn btn-error btn-sm"
                            onclick="document.getElementById('delete_modal_{{ $bill->id }}').showModal()">
                            <i class="fi fi-rr-trash"></i></button>



                        <dialog id='delete_modal_{{ $bill->id }}' class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Delete Data</h3>

                                <p class="py-4">Are you sure to delete the data ?</p>
                                <div class="flex items-center justify-end gap-2">
                                    <form action="{{ route('admin.bills.destroy', ['bill' => $bill->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-accent">
                                            Yes
                                        </button>

                                    </form>

                                    <form method="dialog">
                                        <button class="btn btn-error">No</button>
                                    </form>
                                </div>

                            </div>
                        </dialog>

                    </td>
                </tr>
            @empty
                <td>No bill</td>
            @endforelse
            <tr>
                <td></td>
            </tr>

            {!! $bills->links() !!}
        </x-table-body>



    </div>
</x-dashboard.admin.base>
