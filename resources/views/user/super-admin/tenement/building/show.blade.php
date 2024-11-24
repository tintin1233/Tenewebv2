
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .bg-primary {
    --tw-bg-opacity: 1;
    background-color: var(--fallback-p, oklch(var(--p) / var(--tw-bg-opacity))) !important;
}.bg-secondary {
    --tw-bg-opacity: 1;
    background-color: var(--fallback-s, oklch(var(--s) / var(--tw-bg-opacity))) !important;
}
</style>
<x-dashboard.super-admin.base>
    <x-dashboard.page-label :back_url="route('super-admin.tenements.index')" :title="$building->name" />

    <x-notification-message />

    <div class="row">

        <div class="col-md-6 col-xs-12 col-sm-12">
            <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Amortization</h1>
            <x-pie-chart :data_set="$billAmortization" />
        </div>

        <div class="col-md-6 col-xs-12 col-sm-12">
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
                    <td>
                    </td>
                    <td class="capitalize">
                        {{ $room->status }}
                    </td>
                    <td>
                    </td>
                    <td>
                        {{ $room->tenement->name }}
                    </td>
                    <td>
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


