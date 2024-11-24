
<x-dashboard.super-admin.base>


    <x-notification-message />

    <div class="panel p-2">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-primary">Bills</h1>
            <!-- You can open the modal using ID.showModal() method -->
            {{-- <div class="flex items-center gap-5">
                <a href="{{ route('admin.bills.payments.index') }}" class="btn btn-sm btn-accent text-primay">Payments
                    ({{ $totalPayments }})</a>
                <button class="btn btn-sm btn-primary text-accent" onclick="my_modal_3.showModal()">Create Bills</button>
            </div> --}}

        </div>

        {{-- <h1>
            List of Paid
        </h1> --}}

        <div class="h-auto w-auto"  >
            <x-table-body :columns="['Month', 'Amount', 'Tenant', 'Room Number', 'Type', 'Status', 'Due Date', 'Created By', 'Date & Time']" label="">

                @forelse ($bills as $bill)
                    <tr>
                        <td>

                        </td>
                        <td>
                            {{ $bill->created_at->format('F') }}
                        </td>
                        <td>

                        </td>
                        <td>
                            ₱ {{ number_format($bill->amount) }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{  $bill->tenant->user->profile->last_name }},
                            {{ $bill->tenant->user->profile->first_name }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $bill->tenant->room->room_number }}
                        </td>
                        <td>

                        </td>
                        <td class="capitalize">
                            {{ $bill->type }}
                        </td>
                        <td>

                        </td>
                        <td class="capitalize">
                            {{ $bill->status }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ date('F d, Y', strtotime($bill->due_date)) }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $bill->created_by }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $bill->created_at->format('F d, Y h:s A') }}
                        </td>
                        <td>

                        </td>

                        <td class="flex gap-2 justify-center">
                            <a href="{{ route('super-admin.bills.show', ['bill' => $bill->id]) }}"
                                class="btn btn-accent btn-sm text-primary">
                                View
                            </a>
                            {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                                <i class="fi fi-rr-edit"></i>
                            </a> --}}
                            {{-- <form action="{{ route('admin.bills.destroy', ['bill' => $bill->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-error btn-sm">
                                    <i class="fi fi-rr-trash"></i>
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <td>No bill</td>
                @endforelse
                <tr>
                    <td></td>
                </tr>

                {!! $bills->links() !!}
            </x-table-body>



        </div>



     {{-- <h1>
            List of Unpaid
        </h1>

        <x-table-body :columns="['Month', 'Amount', 'Tenant', 'Room Number', 'Type', 'Status', 'Due Date', 'Created By',  'Date & Time']" label="">

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
                        {{ $bill->tenant->user->name }}
                    </td>
                    <td>
                        {{ $bill->tenant->room->room_number }}
                    </td>
                    <td>
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
                        <a href="{{ route('super-admin.bills.show', ['bill' => $bill->id]) }}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}
                        {{-- <form action="{{ route('admin.bills.destroy', ['bill' => $bill->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-error btn-sm">
                                <i class="fi fi-rr-trash"></i>
                            </button>
                        </form> --}}
               {{--     </td>
                </tr>
            @empty
                <td>No bill</td>
            @endforelse
            <tr>
                <td></td>
            </tr>

            {!! $bills->links() !!}
        </x-table-body> --}}



    </div>
</x-dashboard.super-admin.base>
