<x-dashboard.admin.base>


    <x-notification-message />

    <x-dashboard.page-label :back_url="route('admin.tenants.index')" title="Tenant" />

    <div class="panel p-2">
        <div class="flex gap-2">
            <div class="w-1/5 flex  flex-col gap-2">
                <img src="{{ $tenant->profile->image }}" alt="" srcset="" class="w-full h-64 object-cover">
                <h1 class="text-center text-lg font-bold capitalize text-primary">
                    {{ "{$tenant->profile->last_name}, {$tenant->profile->first_name}" }}
                </h1>
                <h1 class="text-center text-xs font-semibold text-gray-500">
                    {{ $tenant->email }}
                </h1>
            </div>
            <div class="w-5/6 min-h-32 bg-gray-50 rounded-lg p-2">
                <h1 class="text-xl font-bold text-primary capitalize">
                    Personal Information
                </h1>

                <div class="grid grid-cols-3 grid-flow-row gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Last Name</h1>
                        <p>{{ $tenant->profile->last_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">First Name</h1>
                        <p>{{ $tenant->profile->first_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Middle Name</h1>
                        <p>{{ $tenant->profile->middle_name ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Bldg No. & Unit No.</h1>
                        <p>{{ $tenant->tenant->room->room_number ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Account Created</h1>
                        <p>{{ date('F d, Y', strtotime($tenant->tenant->move_in_date)) }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Tenement</h1>
                        <p>{{ $tenant->tenant->room->tenement->name ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Gender</h1>
                        <p>{{ $tenant->profile->gender ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Contact</h1>
                        <p>{{ $tenant->profile->contact ?? 'N\A' }}</p>
                    </div>
                </div>



                <div class="flex flex-col gap-2 mt-5">
                    <x-table-body :columns="['Month', 'Amount', 'Type', 'Status']" label="Bills" >

                        @forelse ($tenant->tenant->bills as $bill)
                            <tr>
                                <td></td>
                                <td>
                                {{ $bill->created_at->format('F') }}
                                </td>
                                <td>
                                    {{ $bill->amount }}
                                </td>
                                <td class="capitalize">
                                    {{ $bill->type }}
                                </td>
                                <td class="capitalize">
                                    {{ $bill->status }}
                                </td>
                                <td class="flex gap-2 justify-center">
                                    <button onclick="bill_modal_{{ $bill->id }}.showModal()"
                                        class="btn btn-accent btn-sm text-primary">
                                        <i class="fi fi-rr-eye"></i>
                                    </button>

                                    <!-- You can open the modal using ID.showModal() method -->

                                    <dialog id="bill_modal_{{ $bill->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h3 class="text-lg font-bold"> Bill</h3>
                                          <!--  <p class="py-4">Press ESC key or click on ✕ button to close</p> -->
                                            <div class="panel p-2  flex  flex-col  gap-2">
                                                <div
                                                    class="flex flex-col justify-center items-center  border-b border-gray-100">
                                                    <div class="flex items-center">
                                                        <img src="{{ asset('logo.png') }}" alt=""
                                                            srcset="" class="h-16 w-16 object-center">
                                                        <h1
                                                            class="text-3xl font-bold tracking-widest text-primary capitalize">
                                                            ciudad de strike</h1>
                                                    </div>
                                                    <p class="text-xs">Phase 1</p>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <h1 class="font-bold capitalize">Month :
                                                        {{ $bill->created_at->format('F') }}</h1>
                                                    <p class="text-xs text-gray-500">
                                                        Gererated At:
                                                        {{ date('F d, Y h:s A', strtotime($bill->created_at)) }}
                                                    </p>
                                                </div>

                                                <h1 class="text-primary font-bold mt-2">
                                                    Type: {{ $bill->type }}
                                                </h1>
                                                <h1 class="text-primary font-bold mt-2">
                                                    Due Date: <span>
                                                        {{ date('F d, Y', strtotime($bill->due_date)) }}</span>
                                                </h1>


                                                <div class="flex flex-col h-full justify-between">
                                                    <div class="grid grid-cols-2 grid-flow-row gap-2">
                                                        <h1 class="font-bold">Status : </h1>
                                                        <div class="w-full flex  justify-end">
                                                            <p> {{ $bill->status }}</p>
                                                        </div>

                                                    </div>
                                                    <div class="grid grid-cols-2 grid-flow-row gap-2">
                                                        <h1 class="font-bold">Amount : </h1>
                                                        <div class="w-full flex  justify-end">
                                                            <p> ₱ {{ number_format($bill->amount, 2) }}</p>
                                                        </div>

                                                    </div>


                                                    <div
                                                        class="grid grid-cols-2 grid-flow-row gap-2 border-t border-gray-100 py-2">
                                                        <h1 class="font-bold">Total : </h1>
                                                        <div class="w-full flex  justify-end">
                                                            <p> ₱ {{ number_format($bill->amount, 2) }}</p>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="flex flex-col gap-2 bg-white rounded-lg shadow-lg">
                                                    @forelse($bill->payments as $payment)
                                                        <div class="py-2 px-4 flex flex-col gap-2"
                                                            x-data="{ open: false }">
                                                            <div class="flex items-center justify-between">
                                                                <h1 class="font-bold text-sm"> <span>Refferrence
                                                                        No.</span> <span>{{ $payment->ref_no }}</span>
                                                                </h1>
                                                                <button class="mr-5" @click="open = !open">
                                                                    <template x-if="!open">
                                                                        <i class="fi fi-rr-angle-small-down"></i>
                                                                    </template>
                                                                    <template x-if="open">
                                                                        <i class="fi fi-rr-angle-small-up"></i>
                                                                    </template>
                                                                </button>
                                                            </div>
                                                            <div class="flex flex-col gap-2 border border-gray-200 rounded-lg p-2 text-sm space-y-5"
                                                                x-show="open" x-transition.duration.700>
                                                                <div class="flex items-center justify-between">
                                                                    <h1>Paid At: </h1>
                                                                    <p>{{ $payment->created_at->format('F d, Y h:s A') }}
                                                                    </p>
                                                                </div>
                                                                <div class="flex items-center justify-between">
                                                                    <h1>Payment Account Number: </h1>
                                                                    <p>{{ $payment->paymentAccount->account_number }}
                                                                    </p>
                                                                </div>
                                                                <div class="flex items-center justify-between">
                                                                    <h1>Amount: </h1>
                                                                    <p>₱ {{ number_format($payment->amount, 2) }}</p>
                                                                </div>

                                                                <h1>Proof of Payment</h1>
                                                                <div class="flex justify-center">
                                                                    <a href="{{ $payment->receipt }}" target="_blank"
                                                                        class="w-5/6">
                                                                        <img src="{{ $payment->receipt }}"
                                                                            alt="" class="w-full aspect-auto">
                                                                    </a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty

                                                        <div class="flex items-center justify-center h-32">
                                                            <h1>No Payment History</h1>
                                                        </div>
                                                    @endforelse


                                                </div>




                                            </div>

                                        </div>
                                    </dialog>
                                    {{-- <a href="{{route('admin.bills.edit', ['bill' => $bill->id])}}" class="btn btn-secodary btn-sm text-primary">
                                        <i class="fi fi-rr-edit"></i>
                                    </a>
                                    <form action="{{route('admin.bills.destroy', ['bill' => $bill->id])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-error btn-sm">
                                            <i class="fi fi-rr-trash"></i>
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td> No Bills Data
                                    <td />
                            </tr>
                        @endforelse

                    </x-table-body>
                </div>
            </div>

        </div>
    </div>
</x-dashboard.admin.base>
