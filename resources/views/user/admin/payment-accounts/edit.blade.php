<x-dashboard.admin.base>


    <x-notification-message />

    <x-dashboard.page-label :back_url="route('admin.payment-accounts.index')" title="Update Payment Account" />

    <div class="panel p-2">
        <form action="{{ route('admin.payment-accounts.update', ['payment_account' => $paymentAccount->id]) }}" method="post"
            class="w-full h-full flex flex-col gap-2">
            @method('put')
            @csrf
            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Unit Number</h1>
                <input type="text" name="name" class="input-generic" value="{{ $paymentAccount->name }}">
            </div>

            @if ($errors->has('name'))
                <p class="text-xs text-error">{{ $errors->first('name') }}</p>
            @endif


            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Account Number</h1>
                <input type="number" name="account_number" class="input-generic"
                    value="{{ $paymentAccount->account_number }}">
            </div>


            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">QR Code <span class="text-xs text-secondary">(Format : jpg)</span></h1>
                <input type="file" name="qr_code" class="file-input file-input-primary text-accemt file-input-sm">
            </div>

            <button class="btn btn-sm btn-primary text-accent">Submit</button>
        </form>
    </div>
</x-dashboard.admin.base>
