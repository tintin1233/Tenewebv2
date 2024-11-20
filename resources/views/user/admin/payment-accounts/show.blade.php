<x-dashboard.admin.base>
    <x-dashboard.page-label :back_url="route('admin.payment-accounts.index')" title="Payment Account" />

    <div class="flex flex-col gap-2 mt-10 items-center">
        <div class="w-1/2 bg-white rounded-lg shadow-lg p-5">
            <div class="flex justify-center w-full">
                <h1 class="flex items-center text-lg font-bold gap-2 w-5/6"> <span>
                        <img src="{{ asset('logo.png') }}" alt="" class="w-20 aspect-square rounded-full"></span>
                    <span class="text-center">
                        CUIDAD DE STRIKE HOMEOWNERS ASSOCIATION, INC
                        <p class="font-thin text-xs text-center">Molino Road, Molino 1, Bacoor City</p>
                    </span>
                </h1>
            </div>
            <div class="flex justify-between gap-2 mt-10">
                <p class="text-xs text-gray-500 items-center">Name : </p>
                <h1 class="text-lg font-primary">{{ $paymentAccount->name }}</h1>
            </div>
            <div class="flex justify-between items-center gap-2">
                <p class="text-xs text-gray-500">Account Number :</p>
                <h1 class="text-lg font-primary">{{ $paymentAccount->account_number }}</h1>
            </div>
            <div class="flex justify-center mt-10">

                @if ($paymentAccount->qr_code)
                    <a href="{{asset($paymentAccount->qr_code)}}" class="w-5/6">
                        <img src="{{ asset($paymentAccount->qr_code) }}" alt="" srcset=""
                            class="w-full aspect-square  object-cover">
                    </a>
                @else
                    <div class="bg-gray-200 rounded-lg w-5/6 aspect-square flex items-center justify-center">
                        <a href="{{route('admin.payment-accounts.edit', ['payment_account' => $paymentAccount->id])}}" class="text-primary">Add QR</a>
                    </div>
                @endif


            </div>
        </div>

    </div>

</x-dashboard.admin.base>
