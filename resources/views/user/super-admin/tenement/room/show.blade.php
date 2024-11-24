@php
    use App\Enums\GeneralStatus;
@endphp
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .bg-primary {
    --tw-bg-opacity: 1;
    background-color: var(--fallback-p, oklch(var(--p) / var(--tw-bg-opacity))) !important;
}.bg-secondary {
    --tw-bg-opacity: 1;
    background-color: var(--fallback-s, oklch(var(--s) / var(--tw-bg-opacity))) !important;
}
</style>
<x-dashboard.super-admin.base>
    <x-dashboard.page-label title="{{ $room->room_number }}" />

    <div class="row">
        <div class="col-md-6 col-xs-6 col-sm-6">
        <x-card label="Unpaid Monthly Amortization" icon="fi fi-rr-peso-sign" :hasCurrency="true" :total="$totalMonthlyDueUnpaid" />
        </div>
        <div class="col-md-6 col-xs-6 col-sm-6">
        <x-card label="Unpaid Monthly Dues" icon="fi fi-rr-peso-sign" :hasCurrency="true" :total="$totalAmortizationUnpaid" />
        </div>
        <div class="col-md-6 col-xs-6 col-sm-6">
        <x-card label="Total Monthly Amortization" icon="fi fi-rr-peso-sig" :hasCurrency="true" :total="$totalAmortization" />
        </div>
        <div class="col-md-6 col-xs-6 col-sm-6">
        <x-card label="Total Monthly Dues" icon="fi fi-rr-peso-sig" :hasCurrency="true" :total="$totalMonthlyDue" />
        </div>
    </div>


    {{-- <div class="panel p-2 flex flex-col gap-2">


        <div class="flex gap-2 w-full">
            <div class="grow flex flex-col gap-2">
                <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Units</h1>
                <x-pie-chart :data_set="$pieDataSet" />
            </div>
            <div class="grow flex flex-col gap-2">
                <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Amortization</h1>
                <x-line-chart :data_set="$monthlyDataSet" title="Monthly Dues & Amortization Trends by Month" />
            </div>
        </div>

    </div> --}}


    <div class="panel p-2 flex flex-col gap-2">
        @php
            $tenant = $room->tenants()->whereNull('move_out_date')->first();
        @endphp

        @if ($tenant)
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-12">
                    <img src="{{ $tenant->user->profile->image }}" class="w-full h-auto object-cover object-center" />
                </div>


                <div class="col-md-8 col-xs-12 col-sm-12">
                    <h1 class="text-xl font-bold text-primary capitalize">
                        Personal Information
                    </h1>

                    <div class="grid grid-cols-3 grid-flow-row gap-5">
                        <div class="flex flex-col gap-2">
                            <h1 class="text-xs text-gray-500">Last Name</h1>
                            <p>{{ $tenant->user->profile->last_name }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="text-xs text-gray-500">First Name</h1>
                            <p>{{ $tenant->user->profile->first_name }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="text-xs text-gray-500">Middle Name</h1>
                            <p>{{ $tenant->user->profile->middle_name ?? 'N\A' }}
                            </p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="text-xs text-gray-500">Room Number</h1>
                            <p>{{ $tenant->room->room_number ?? 'N\A' }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="text-xs text-gray-500">Move in Date</h1>
                            <p>{{ date('F d, Y', strtotime($tenant->move_in_date)) }}
                            </p>
                        </div>

                        <div class="flex flex-col gap-2">
                            <h1 class="text-xs text-gray-500">Gender</h1>
                            <p>{{ $tenant->user->profile->gender ?? 'N\A' }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <h1 class="text-xs text-gray-500">Contact</h1>
                            <p>{{ $tenant->user->profile->contact ?? 'N\A' }}</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-2">
                        <h1 class="text-xl font-bold text-primary capitalize">
                            Family Member
                        </h1>
                    </div>

                    <div class="flex flex-col gap-2 mt-2">
                        <x-table-body :columns="['name', 'status', 'Date of Birth', 'Relationship with Head']" label="">

                                <tr>
                                    <td>123</td>
                                    <td>123</td>
                                    <td>123</td>
                                    <td>123</td>
                                    <td>123</td>
                                    <td>123</td>

                                </tr>
                            @foreach ($tenant->user->familyMembers as $family)
                                <tr>
                                    <td></td>
                                    <td>{{ $family->name }}</td>
                                    <td>{{ $family->status }}</td>
                                    <td>{{ $family->birthdate }}</td>
                                    <td>{{ $family->relationship }}</td>
                                    <td class="flex gap-2 justify-center">
                                        <button
                                            onclick="document.getElementById('show_modal_{{ $family->id }}').showModal()"
                                            class="btn btn-accent btn-sm text-primary">
                                            <i class="fi fi-rr-eye"></i>
                                        </button>

                                        <dialog id="show_modal_{{ $family->id }}" class="modal">
                                            <div class="modal-box">
                                                <form method="dialog">
                                                    <button
                                                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                                </form>
                                                <h3 class="text-lg font-bold">Family Member - {{ $family->name }}</h3>
                                                <div class="flex flex-col gap-2">
                                                    <h1 class="text-xs text-gray-500">Name</h1>
                                                    <p>{{ $family->name }}</p>
                                                </div>
                                                <div class="flex flex-col gap-2">
                                                    <h1 class="text-xs text-gray-500">Status</h1>
                                                    <p>{{ $family->status }}</p>
                                                </div>
                                                <div class="flex flex-col gap-2">
                                                    <h1 class="text-xs text-gray-500">Date of Birth</h1>
                                                    <p>{{ $family->birthdate }}</p>
                                                </div>
                                                <div class="flex flex-col gap-2">
                                                    <h1 class="text-xs text-gray-500">Relationship with Head</h1>
                                                    <p>{{ $family->relationship }}</p>
                                                </div>
                                            </div>
                                        </dialog>
                                        <button
                                            onclick="document.getElementById('edit_modal_{{ $family->id }}').showModal()"
                                            class="btn btn-secodary btn-sm text-primary">
                                            <i class="fi fi-rr-edit"></i>
                                        </button>
                                        <dialog id="edit_modal_{{ $family->id }}" class="modal">
                                            <div class="modal-box">
                                                <form method="dialog">
                                                    <button
                                                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                                </form>
                                                <h3 class="text-lg font-bold">EditFamily</h3>
                                                <form action="{{ route('tenant.family-members.store') }}"
                                                    method="post" class="flex flex-col gap-2">
                                                    @csrf
                                                    <div class="flex flex-col gap-2">
                                                        <h1 class="input-generic-label">Name</h1>
                                                        <input type="text" name="name" class="input-generic"
                                                            value="{{ $family->name }}">
                                                        @error('name')
                                                            <p class="text-xs text-error">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="flex flex-col gap-2">
                                                        <h1 class="input-generic-label">Status</h1>
                                                        <input type="text" name="status" class="input-generic"
                                                            value="{{ $family->status }}">
                                                        @error('status')
                                                            <p class="text-xs text-error">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="flex flex-col gap-2">
                                                        <h1 class="input-generic-label">Date of Birth</h1>
                                                        <input type="date" name="date_of_birth" class="input-generic"
                                                            value="{{ $family->birthdate }}">
                                                        @error('date_of_birth')
                                                            <p class="text-xs text-error">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>
                                                    <div class="flex flex-col gap-2">
                                                        <h1 class="input-generic-label">Relationship with Head</h1>
                                                        <input type="text" name="relationship_with_head"
                                                            value="{{ $family->relationship }}" class="input-generic">
                                                        @error('relationship_with_head')
                                                            <p class="text-xs text-error">
                                                                {{ $message }}
                                                            </p>
                                                        @enderror
                                                    </div>


                                                    <div class="flex justify-end gap-2">
                                                        <button class="btn btn-accent">Update</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </dialog>
                                        <button
                                            onclick="document.getElementById('delete_modal_{{ $family->id }}').showModal()"
                                            class="btn btn-error btn-sm">
                                            <i class="fi fi-rr-trash"></i>
                                        </button>
                                        <dialog id="delete_modal_{{ $family->id }}" class="modal">
                                            <div class="modal-box">
                                                <form method="dialog">
                                                    <button
                                                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                                </form>
                                                <h1 class="text-lg font-bold">
                                                    Delete
                                                </h1>
                                                <p>Are you sure to delete this data ?</p>
                                                <div class="flex items-center gap-2 mt-10">
                                                    <form
                                                        action="{{ route('tenant.family-members.destroy', ['family_member' => $family->id]) }}"
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
                            @endforeach


                        </x-table-body>

                        <!-- You can open the modal using ID.showModal() method -->

                        <dialog id="add_family_modal" class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Add Family</h3>
                                <form action="{{ route('tenant.family-members.store') }}" method="post"
                                    class="flex flex-col gap-2">
                                    @csrf
                                    <div class="flex flex-col gap-2">
                                        <h1 class="input-generic-label">Name</h1>
                                        <input type="text" name="name" class="input-generic">
                                        @error('name')
                                            <p class="text-xs text-error">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <h1 class="input-generic-label">Status</h1>
                                        <input type="text" name="status" class="input-generic">
                                        @error('status')
                                            <p class="text-xs text-error">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <h1 class="input-generic-label">Date of Birth</h1>
                                        <input type="date" name="date_of_birth" class="input-generic">
                                        @error('date_of_birth')
                                            <p class="text-xs text-error">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <h1 class="input-generic-label">Relationship with Head</h1>
                                        <input type="text" name="relationship_with_head" class="input-generic">
                                        @error('relationship_with_head')
                                            <p class="text-xs text-error">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>


                                    <div class="flex justify-end gap-2">
                                        <button class="btn btn-accent">Add</button>
                                    </div>

                                </form>
                            </div>
                        </dialog>
                    </div>




                    {{-- <div class="flex flex-col gap-2 mt-5">
                        <x-table-body :columns="['name', 'amount', 'type', 'status']" label="Bills">

                            @forelse ($tenant->bills as $bill)
                                <tr>
                                    <td></td>
                                    <td>
                                        {{ $bill->name }}
                                    </td>
                                    <td>
                                        {{ $bill->amount }}
                                    </td>
                                    <td>
                                        {{ $bill->type }}
                                    </td>
                                    <td>
                                        {{ $bill->status }}
                                    </td>
                                    <td class="flex gap-2 justify-center">

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td> No Bills Data
                                        <td />
                                </tr>
                            @endforelse

                        </x-table-body> --}}
                </div>
            </div>

    </div>
@else
    <div class="w-full h-full flex justify-center items-center bg-gray-100 rounded-lg min-h-96">
        <h1 class="text-lg font-bold text-primary">
            No Current Tenant
        </h1>
    </div>
    @endif

    {{-- @php
            $bills = $room
                ->bills()
                ->where('status', GeneralStatus::PAID->value)
                ->paginate(10);
        @endphp
        <h1>
            List of Paid
        </h1> --}}

    {{-- <div class="h-auto w-auto" x-data="billCreate" > --}}
    {{-- <x-table-body :columns="[
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
                            ₱ {{ number_format($bill->amount, 2) }}
                        </td>
                        <td {{ $bill->tenant->user->profile->last_name }},
                            {{ $bill->tenant->user->profile->first_name }} </td>
                        <td>
                            {{ $bill->tenant->room->room_number }}
                        </td>
                        <td class="capitalize">
                            {{ $bill->type }}
                        </td>
                        <td>
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

                        </td>
                    </tr>
                @empty
                    <td>No bill</td>
                @endforelse
                <tr>
                    <td></td>
                </tr>

                {!! $bills->links() !!}
            </x-table-body> --}}


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

                            <option value="all">All</option>
                            <option value="specific">Specific</option>

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
                                <h1 class="input-generic-label">month</h1>
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
                        <select name="type" class="select select-primary w-full select-sm capitalize text-xs">
                            <option :value="null">Select</option>
                            <option value="monthly dues">Monthly Dues</option>
                            <option value="monthly amortization"> “Monthly
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

    {{-- </div> --}}

    @php
        $unpaidBills = $room
            ->bills()
            ->where('status', GeneralStatus::UNPAID->value)
            ->paginate(10);
    @endphp

    {{-- <h1>
            List of Unpaid
        </h1> --}}

    {{-- <x-table-body :columns="['Month', 'Amount', 'Tenant', 'Unit No.', 'Type', 'Status', 'Due Date', 'Created By', 'Date & Time']" label="">

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
                        <a href="#" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>

                    </td>
                </tr>
            @empty
                <td>No bill</td>
            @endforelse
            <tr>
                <td></td>
            </tr>

            {!! $bills->links() !!}
        </x-table-body> --}}


    <x-table-body :columns="['name', 'room number', 'Move Out Date']" label="Previous Tenants">

        @forelse ($room->tenants()->whereNotNull('move_out_date')->get() as $tenant)
            <tr>
                <td>

                </td>
                <td>
                    {{ $tenant->name }}
                </td>
                <td>
                    {{ $tenant->tenant->room->room_number }}
                </td>
                <td>
                    {{ date('F d, Y', strtotime($tenant->tenant->move_out_date)) }}
                </td>

                <td class="flex gap-2 justify-center">

                </td>
            </tr>
        @empty
            <td>No Tenant</td>
        @endforelse
        <tr>
            <td></td>
        </tr>
    </x-table-body>

    </div>





</x-dashboard.super-admin.base>
