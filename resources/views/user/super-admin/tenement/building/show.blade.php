<x-dashboard.super-admin.base>
    <x-dashboard.page-label :back_url="route('super-admin.tenements.index')" :title="$building->name" />

    <x-notification-message />

    <div class="grid grid-cols-2 grid-flow-row gap-2">

        <div class="grow flex flex-col gap-2">
            <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Amortization</h1>
            <x-pie-chart :data_set="$billAmortization" />
        </div>

        <div class="grow flex flex-col gap-2">
            <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Dues</h1>
            <x-pie-chart :data_set="$billMonthlyDue" />
        </div>

    </div>

    <div class="panel p-2" style="overflow-x:auto;">
        <x-table-body label="Units" :columns="['Unit no.', 'Status', 'Tenement']" :search_url="route('super-admin.buildings.show', ['building' => $building->id])">


            @forelse ($rooms as $room)
                <tr>
                    <td></td>
                    <td>
                        {{ $room->room_number }}
                    </td>
                    <td class="capitalize">
                        {{ $room->status }}
                    </td>
                    <td>
                        {{ $room->tenement->name }}
                    </td>
                    <td class="flex gap-2 justify-center">
                        <a href="{{route('super-admin.buildings.room.room', ['room' => $room->id])}}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        {{-- <a href="{{ route('admin.rooms.edit', ['room' => $room->id]) }}"
                            class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a>
                        <form action="{{ route('admin.rooms.destroy', ['room' => $room->id]) }}"
                            method="post">
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
                        No Units
                    </td>
                </tr>
            @endforelse
        </x-table-body>

        {!! $rooms->links() !!}
    </div>
</x-dashboard.super-admin.base>


