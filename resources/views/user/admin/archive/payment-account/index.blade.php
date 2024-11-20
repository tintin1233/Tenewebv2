<x-dashboard.admin.base>

    <div class="panel p-2">
        <x-table-body label="Archived - Payment Accounts" :columns="[
            'Name', 'Account Number', 'Qr Code',
            'Date and time',
        ]" >
            @forelse ($paymentAccounts as $paymentAccount)


                <tr>

                    <td>

                    </td>

                    <td>
                        {{ $paymentAccount->name }}
                    </td>
                    <td>
                        {{ $paymentAccount->account_number }}
                    </td>
                    <td>

                        @if ($paymentAccount->qr_code)
                            <a  href="{{ $paymentAccount->qr_code }}">
                                <img src="{{ $paymentAccount->qr_code }}" alt="" srcset=""
                                    class="w-12 aspect-square">
                            </a>
                        @else
                            N\A
                        @endif

                    </td>
                    <td>
                        {{$paymentAccount->created_at->format("F d, Y h:s A")}}
                    </td>
                    <td class="flex gap-2 justify-center">
                        {{-- <a href="{{route('admin.announcements.show', ['announcement' => $announcement->id])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a> --}}
                        <a href="{{ route('admin.payment-accounts.restore', ['payment_account' => $paymentAccount->id]) }}"
                            class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-time-past"></i>
                        </a>

                        <!-- Open the modal using ID.showModal() method -->
                        <button class="btn btn-sm btn-error" onclick="my_modal_1.showModal()"> <i class="fi fi-rr-trash"></i></button>
                        <dialog id="my_modal_1" class="modal">
                            <div class="modal-box">
                                <h3 class="text-lg font-bold">Are you Sure ? </h3>
                                <p class="py-4">Data will permanently Deleted!</p>

                                <div class="modal-action">
                                    <form action="{{route('admin.payment-accounts.delete', ['payment_account' => $paymentAccount->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-accent">Confirm</button>
                                    </form>

                                    <form method="dialog">
                                        <!-- if there is a button in form, it will close the modal -->
                                        <button class="btn btn-sm">Close</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                        {{-- <form action="{{route('admin.announcements.delete', ['announcement' => $announcement->id])}}" method="post">
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
                    <td>
                        No paymentAccounts
                    </td>
                </tr>
            @endforelse
        </x-table-body>
        {!! $paymentAccounts->links() !!}
    </div>
</x-dashboard.admin.base>
