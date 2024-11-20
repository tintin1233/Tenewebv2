<x-dashboard.admin.base>

    <x-notification-message />
    <div class="panel p-2">
        <x-table-body label="Archived - Units" :columns="[
            'room no.',
            'status',
            'tenement'
        ]"  >
            @forelse ($rooms as $room)
                <tr>
                    <td></td>
                    <td>
                        {{ $room->room_number }}
                    </td>
                    <td>
                        {{$room->status}}
                    </td>
                    <td>
                        {{$room->tenement->name}}
                    </td>
                    <td class="flex gap-2 justify-center">
                        <a href="{{route('admin.rooms.archives', ['room' => $room->id, 'action' => 'restore'])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-time-past"></i>
                        </a>
                        {{-- <a href="{{ route('admin.rooms.edit', ['room' => $room->id]) }}"
                            class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}
                        <a href="{{route('admin.rooms.archives', ['room' => $room->id, 'action' => 'delete'])}}">
                            <button class="btn btn-error btn-sm">
                                <i class="fi fi-rr-trash"></i>
                            </button>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        No Rooms
                    </td>
                </tr>
            @endforelse
        </x-table-body>
        {!! $rooms->links() !!}
    </div>
</x-dashboard.admin.base>
