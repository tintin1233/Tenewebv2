<x-dashboard.admin.base>


    <x-notification-message />

    <x-dashboard.page-label :back_url="route('admin.tenants.show', ['tenant' => $tenant->id])" title="Advance Payment" />

    <div class="panel p-2">
        <form action="{{ route('admin.bills.store') }}" method="post"
        class="w-full h-full flex flex-col gap-2">
        @csrf

        <div class="flex flex-col gap-2">
            <h1 class="input-generic-label">Month</h1>
            <input type="text" name="month" class="input-generic">
        </div>

        <input type="hidden" name="tenant" value="{{$tenant->tenant->id}}">

        @if ($errors->has('name'))
            <p class="text-xs text-error">{{ $errors->first('name') }}</p>
        @endif

        <div class="flex flex-col gap-2">
            <h1 class="input-generic-label">Amount</h1>
            <input type="number" name="amount" class="input-generic">
        </div>
        @if ($errors->has('amount'))
            <p class="text-xs text-error">{{ $errors->first('amount') }}</p>
        @endif
        <div class="flex flex-col gap-2">
            <h1 class="input-generic-label">Type</h1>
            <select name="type" class="select select-primary w-full select-sm text-sm">
                <option disabled selected>Select</option>
                <option value="montly dues">Monthly Dues</option>
                <option value="amortization">Monthly Amortization</option>
                <option value="amilyar">Amilyar</option>
            </select>
            @if ($errors->has('type'))
                <p class="text-xs text-error">{{ $errors->first('type') }}</p>
            @endif
        </div>

        <button class="btn btn-sm btn-primary text-accent">Submit</button>
    </form>
    </div>
</x-dashboard.admin.base>
