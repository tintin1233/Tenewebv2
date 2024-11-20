@php
    use App\Enums\GeneralStatus;
@endphp

<x-dashboard.admin.base>
    <div class="grid grid-cols-3 grid-flow-row gap-2 h-32">
        <a href="#" class="h-full w-full">
            <x-card label="Units" icon="fi fi-rr-bed-alt" :total="$roomTotal" />
        </a>
        <a href="#" class="h-full w-full">
            <x-card label="available Units" icon="fi fi-rr-bed-alt" :total="$vacantRoomTotal" />
        </a>
        <a href="#" class="h-full w-full">
            <x-card label="occupied Units" icon="fi fi-rr-bed-alt" :total="$occupiedRoomTotal" />
        </a>
    </div>

    <div class="panel p-2">
        <x-table-body useLabelWithOptions="true" labelOptionsName="UNITS" :options="[
            [
                'url' => route('admin.rooms.index', ['search' => GeneralStatus::VACANT->value]),
                'name' => 'Available Units',
            ],
            [
                'url' => route('admin.rooms.index', ['search' => GeneralStatus::OCCUPIED->value]),
                'name' => 'Occupied Units',
            ],
        ]" :columns="['Bldg No. & Unit No.', 'Status', 'Tenement']"
            :archived_url="route('admin.rooms.archives')"
            :search_url="route('admin.rooms.index')" >
            {{-- <x-slot name="additionalLabel">
                <div class="ml-5 divide-x-2 divide-gray-800 flex items-center gap-2">
                    <a class="font-bold capitalize hover:bg-primary hover:text-accent
                 hover:scale-105 px-4 py-2 rounded-lg duration-700"
                        href="{{ route('admin.rooms.index', ['search' => GeneralStatus::VACANT->value]) }}">
                        {{GeneralStatus::VACANT->value}}
                    </a>
                    <a class="font-bold capitalize hover:bg-primary hover:text-accent
                 hover:scale-105 px-4 py-2 rounded-lg duration-700"
                        href="{{ route('admin.rooms.index', ['search' => GeneralStatus::OCCUPIED->value]) }}">
                        {{GeneralStatus::OCCUPIED->value}}
                    </a>
                </div>
            </x-slot> --}}
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
                        <a href="{{ route('admin.rooms.show', ['room' => $room->id]) }}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        {{-- <a href="{{ route('admin.rooms.edit', ['room' => $room->id]) }}"
                            class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}

                        {{-- <button class="btn btn-error btn-sm" onclick="document.getElementById('delete_modal_{{$room->id}}').showModal()">
                            <i
                                class="fi fi-rr-box"></i></button> --}}



                        <dialog id='delete_modal_{{$room->id}}' class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Data Archive Confirmation</h3>

                                <p class="py-4">Are you sure to archive this unit ?</p>
                                <div class="flex items-center justify-end gap-2">
                                    <form
                                    action="{{ route('admin.rooms.destroy', ['room' => $room->id]) }}"
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
</x-dashboard.admin.base>
