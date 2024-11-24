<style>
/* Responsive Design */
@media (max-width: 768px) {
    .text-3xl{
        font-size:2vh;
    }
}
</style>
<x-dashboard.super-admin.base>
    <x-dashboard.page-label title="bill" :back_url="route('super-admin.bills.index')" />
    <div class="panel p-2  flex  flex-col  gap-2">
        <div class="flex flex-col justify-center items-center  border-b border-gray-100">
            <div class="flex items-center">
                <img src="{{ asset('logo.png') }}" alt="" srcset="" class="h-16 w-16 object-center">
                <h1 class="text-3xl font-bold tracking-widest text-primary capitalize">ciudad de strike</h1>
            </div>
            <p class="text-xs">Phase 1</p>
        </div>
        <div class="flex justify-between items-center">
            <h1 class="font-bold capitalize">Month : {{ $bill->created_at->format('F') }}</h1>
            <p class="text-xs text-gray-500">
                Gererated At: {{ date('F d, Y h:s A', strtotime($bill->created_at)) }}
            </p>
        </div>

        <h1 class="text-primary font-bold mt-2">
            Type: {{ $bill->type }}
        </h1>
        <h1 class="text-primary font-bold mt-2">
            Due Date: <span> {{ date('F d, Y', strtotime($bill->due_date)) }}</span>
        </h1>


        <div class="flex flex-col h-full justify-between">
            <div class="grid grid-cols-2 grid-flow-row gap-2">
                <h1 class="font-bold">Status : </h1>
                <div class="w-full flex  justify-end">
                    <p> {{$bill->status }}</p>
                </div>

            </div>
            <div class="grid grid-cols-2 grid-flow-row gap-2">
                <h1 class="font-bold">Amount : </h1>
                <div class="w-full flex  justify-end">
                    <p> ₱ {{ number_format($bill->amount, 2) }}</p>
                </div>

            </div>


            <div class="grid grid-cols-2 grid-flow-row gap-2 border-t border-gray-100 py-2">
                <h1 class="font-bold">Total : </h1>
                <div class="w-full flex  justify-end">
                    <p> ₱ {{ number_format($bill->amount, 2) }}</p>
                </div>
            </div>

        </div>

        <div class="flex flex-col gap-2 bg-white rounded-lg shadow-lg">
            @forelse($bill->payments as $payment)
                <div class="py-2 px-4 flex flex-col gap-2" x-data="{ open: false }">
                    <div class="flex items-center justify-between">
                        <h1 class="font-bold text-sm"> <span>Refferrence No.</span> <span>{{ $payment->ref_no }}</span>
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
                    <div class="flex flex-col gap-2 border border-gray-200 rounded-lg p-2 text-sm space-y-5" x-show="open"
                        x-transition.duration.700>
                        <div class="flex items-center justify-between">
                            <h1>Paid At: </h1>
                            <p>{{ $payment->created_at->format('F d, Y h:s A') }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <h1>Payment Account Number: </h1>
                            <p>{{ $payment->paymentAccount->account_number }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <h1>Amount: </h1>
                            <p>₱ {{ number_format($payment->amount, 2) }}</p>
                        </div>

                        <h1>Receipt</h1>
                        <div class="flex justify-center">
                            <a href="{{ $payment->receipt }}" target="_blank" class="w-5/6">
                                <img src="{{ $payment->receipt }}" alt="" class="w-full aspect-auto">
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
</x-dashboard.super-admin.base>
