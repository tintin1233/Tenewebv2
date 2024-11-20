<x-dashboard.tenant.base>


    <x-notification-message />

    <x-dashboard.page-label title="Bills" />

    <div class="panel p-2">
        <x-table-body :columns="['Month', 'Amount',   'Status' , 'Due Date', 'Date & Time']" label="">

            @forelse ($bills as $bill)
                <tr class="{{!$bill->is_viewed ? 'font-bold' : ' '}}">
                    <td>

                    </td>
                    <td>
                        {{ $bill->created_at->format('F') }}
                    </td>
                    <td>
                        ₱ {{ number_format($bill->amount, 2) }}
                    </td>
                    {{-- <td>
                        {{ $bill->tenant->user->name }}
                    </td> --}}
                     {{-- <td>
                        {{ $bill->tenant->room->room_number }}
                    </td> --}}
                    <td class="capitalize">
                        {{ $bill->status }}
                    </td>
                    <td>
                        {{ date('F d, Y', strtotime($bill->due_date)) }}
                    </td>
                    <td>
                        {{ $bill->created_at->format('F d, Y h:s A') }}
                    </td>

                    <td class="flex gap-2 justify-center">
                        <a href="{{ route('tenant.bills.show', ['bill' => $bill->id]) }}"
                            class="btn btn-accent btn-sm text-primary">
                          View
                        </a>
                        {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}
                        {{-- <form action="{{ route('tenant.bills.destroy', ['bill' => $bill->id]) }}" method="post">
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
</x-dashboard.tenant.base>
