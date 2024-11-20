<x-dashboard.admin.base>


    <x-notification-message />

    <div class="panel p-2">
        <x-dashboard.page-label title="Payments" :back_url="route('admin.bills.index')" />

        {{-- <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-primary">Payments</h1>
            <!-- You can open the modal using ID.showModal() method -->
        </div> --}}


        <x-table-body :columns="['Date Paid', 'referrence number', 'amount', 'status', 'reciept']" label="">

            @forelse ($payments as $payment)
                <tr>
                    <td>

                    </td>

                    <td>
                        {{ $payment->created_at->format('F d, Y h:s A') }}
                    </td>
                     <td>
                        {{ $payment->ref_no }}
                    </td>
                    <td>
                        ₱ {{ number_format($payment->amount, 2) }}
                    </td>
                    <td>
                        {{$payment->status}}
                    </td>
                    <td>
                        <a href="{{ $payment->receipt }}" target="_blank" class="w-5/6">
                            <img src="{{ $payment->receipt }}" alt="" class="w-12 aspect-auto">
                        </a>
                    </td>


                    <td class="flex gap-2 justify-center">
                        <a href="{{ route('admin.bills.payments.show', ['payment' => $payment->id]) }}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}
                      <form action="{{ route('admin.bills.payments.destroy', ['payment' => $payment->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-error btn-sm">
                                <i class="fi fi-rr-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <td>No payment</td>
            @endforelse
            <tr>
                <td></td>
            </tr>

            {!! $payments->links() !!}
        </x-table-body>



    </div>
</x-dashboard.admin.base>
