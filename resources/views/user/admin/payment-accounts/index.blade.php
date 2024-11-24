<x-dashboard.admin.base>


    <x-notification-message />


<style>
    @media (max-width: 768px) {
        .text-2xl {
            display: none;
        }
    }
</style>
    <div class="panel p-2" style="overflow-x:auto;">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-primary">Payment Accounts</h1>
            <!-- You can open the modal using ID.showModal() method -->
            <button class="btn btn-sm btn-primary text-accent" onclick="my_modal_3.showModal()">Add Payment
                Account</button>
        </div>


        <x-table-body :columns="['Name', 'Account Number', 'Qr Code', 'Date & Time']" label="">

            @forelse ($paymentAccounts as $paymentAccount)
                <tr>
                    <td>

                    </td>

                    <td>
                        {{ $paymentAccount->name }}
                    </td>
                    <td>

                    </td>
                    <td>
                        {{ $paymentAccount->account_number }}
                    </td>
                    <td>

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

                    </td>
                    <td>
                        {{ $paymentAccount->created_at->format('F d, Y h:s A') }}
                    </td>
                    <td>

                    </td>

                    <td class="flex gap-2 justify-center">
                        <a href="{{ route('admin.payment-accounts.show', ['payment_account' => $paymentAccount->id]) }}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                         <a href="{{route('admin.payment-accounts.edit', ['payment_account' =>  $paymentAccount->id])}}" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a>
                        

                        <button class="btn btn-error btn-sm" onclick="document.getElementById('delete_modal_{{$paymentAccount->id}}').showModal()">
                            <i
                                class="fi fi-rr-trash"></i></button>



                        <dialog id='delete_modal_{{$paymentAccount->id}}' class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Delete Data</h3>
                                
                                <p class="py-4">Are you sure to delete the data ?</p>
                                <div class="flex items-center justify-end gap-2">
                                    <form
                                    action="{{ route('admin.payment-accounts.destroy', ['payment_account' => $paymentAccount->id]) }}"
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
                <td>No Payment Account</td>
            @endforelse
            <tr>
                <td></td>
            </tr>

            {!! $paymentAccounts->links() !!}
        </x-table-body>


        <dialog id="my_modal_3" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="text-lg font-bold text-primary">Add Payment Account</h3>
                <div class="panel p-2">
                    <form action="{{ route('admin.payment-accounts.store') }}" method="post"
                        class="w-full h-full flex flex-col gap-2" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="flex flex-col gap-2">
                            <h1 class="input-generic-label">name</h1>
                            <input type="text" name="name" class="input-generic">
                        </div>

                        @if ($errors->has('name'))
                            <p class="text-xs text-error">{{ $errors->first('name') }}</p>
                        @endif --}}


                        <div class="flex flex-col gap-2">
                            <h1 class="input-generic-label">Name</h1>
                            <input type="text" name="name" class="input-generic">
                        </div>
                        @if ($errors->has('name'))
                            <p class="text-xs text-error">{{ $errors->first('name') }}</p>
                        @endif
                        <div class="flex flex-col gap-2">
                            <h1 class="input-generic-label">Account Number</h1>
                            <input type="number" name="account_number" class="input-generic">
                        </div>
                        @if ($errors->has('account_number'))
                            <p class="text-xs text-error">{{ $errors->first('account_number') }}</p>
                        @endif
                        <div class="flex flex-col gap-2">
                            <h1 class="input-generic-label">QR Code <span class="text-xs text-secondary">(Format : jpg)</span></h1>
                            <input type="file" name="qr_code"  class="file-input file-input-primary text-accemt file-input-sm">
                        </div>


                        <button class="btn btn-sm btn-primary text-accent">Submit</button>
                    </form>
                </div>
        </dialog>
    </div>
</x-dashboard.admin.base>
