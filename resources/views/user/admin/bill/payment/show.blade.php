<x-dashboard.admin.base>


    <x-notification-message />

    <x-dashboard.page-label title="Payment Summary" :back_url="route('admin.bills.payments.index')" />

    <div class="panel p-2  flex  flex-col  gap-2">

        <div class="flex items-center justify-end">
            <div class="flex items-center gap-2">


                @if ($payment->status !== 'verified')
                    <form action="{{ route('admin.bills.payments.verified', ['payment' => $payment->id]) }}"
                        method="post">

                        @csrf
                        @method('PUT')

                        <button class="btn btn-sm btn-success">
                            Verified
                        </button>
                    </form>
                    <form action="{{ route('admin.bills.payments.reject', ['payment' => $payment->id]) }}" method="post">

                        @csrf
                        @method('PUT')

                        <button class="btn btn-sm btn-error">
                            Reject
                        </button>
                    </form>
                @endif
                <form action="{{ route('admin.bills.payments.destroy', ['payment' => $payment->id]) }}" method="post">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-sm btn-error">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        <div class="grid grid-cols-2 grid-flow-row gap-2">
            <div class="flex flex-col gap-2 border-l-4 p-2 border-primary rounded-l-lg shadow-lg">

                <div class="flex items-center justify-between">
                    <h1 class="text-lg font-bold border-b border-gray-200">
                        Payment
                    </h1>

                    <h1 class="flex items-center gap-2 text-sm">
                        <span>Status </span>
                        <span>{{ $payment->status }}</span>
                    </h1>
                </div>



                <div class="flex items-center justify-between border-b border-dashed border-gray-200 py-2">
                    <h1>
                        Referrence No
                    </h1>
                    <h1>
                        {{ $payment->ref_no }}
                    </h1>
                </div>
                <div class="flex items-center justify-between border-b border-dashed border-gray-200 py-2">
                    <h1>
                        Paid At
                    </h1>
                    <h1>
                        {{ $payment->created_at->format('F d, Y h:s A') }}
                    </h1>
                </div>
                <div class="flex items-center justify-between border-b border-dashed border-gray-200 py-2">
                    <h1>
                        Amount
                    </h1>
                    <h1>
                        ₱ {{ number_format($payment->amount, 2) }}
                    </h1>
                </div>

                <h1>
                    Proof of Payment
                </h1>
                <div class="flex justify-center">
                    <a href="{{ $payment->receipt }}" class="w-1/2 aspect-auto" target="_blank">
                        <img src="{{ $payment->receipt }}" alt="" srcset="" class=""
                            class="w-full aspect-auto">
                    </a>

                </div>
            </div>
            <div class="flex flex-col gap-2 border-l-4 p-2 border-accent rounded-l-lg shadow-lg">
                @php
                    $bill = $payment->bill;
                @endphp
                <div class="flex items-center justify-between">
                    <h1 class="text-lg font-bold border-b border-gray-200">
                        Bill
                    </h1>

                    <h1 class="flex items-center gap-2 text-sm">
                        <span>Status </span>
                        <span>{{ $bill->status }}</span>
                    </h1>
                </div>



                <div class="flex items-center justify-between border-b border-dashed border-gray-200 py-2">
                    <h1>
                        Type
                    </h1>
                    <h1>
                        {{ $bill->type }}
                    </h1>
                </div>
                <div class="flex items-center justify-between border-b border-dashed border-gray-200 py-2">
                    <h1>
                        Due Date
                    </h1>
                    <h1>
                        {{ date('F d, Y', strtotime($bill->due_date)) }}
                    </h1>
                </div>
                <div class="flex items-center justify-between border-b border-dashed border-gray-200 py-2">
                    <h1>
                        Amount:
                    </h1>
                    <h1>
                        ₱ {{ number_format($bill->amount, 2) }}
                    </h1>
                </div>
            </div>
        </div>


    </div>
</x-dashboard.admin.base>
