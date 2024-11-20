<x-dashboard.admin.base>

    <x-notification-message />

    <div class="panel p-2">
        <x-table-body label="Archived - Master List" :columns="[
            'Last Name', 'First Name', 'Middle Name', 'Room Number', 'Date and Time'
        ]" >
            @forelse ($masterLists as $masterList)


                <tr>
                    <td></td>
                    <td>
                        {{ $masterList->last_name }}
                    </td>
                    <td>
                        {{ $masterList->first_name }}
                    </td>
                    <td>
                        {{ $masterList->middle_name ?? 'N\A' }}
                    </td>
                    <td>
                        {{ $masterList->room_number }}
                    </td>
                    <td>
                        {{$masterList->created_at->format('F d, Y h:s A')}}
                    </td>

                    <td class="flex gap-2 justify-center">
                        {{-- <a href="{{route('admin.announcements.show', ['announcement' => $announcement->id])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </> --}}
                        <a href="{{ route('admin.master-list.restore', ['master_list' => $masterList->id]) }}"
                            class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-time-past"></i>
                        </a>

                        <!-- Open the modal using ID.showModal() method -->
                        <button class="btn btn-sm btn-error" onclick="my_modal_{{$masterList->id}}.showModal()"> <i class="fi fi-rr-trash"></i></button>
                        <dialog id="my_modal_1" class="modal">
                            <div class="modal-box">
                                <h3 class="text-lg font-bold">Are you Sure ? </h3>
                                <p class="py-4">Data will permanently Deleted!</p>

                                <div class="modal-action">
                                    <form action="{{route('admin.master-list.delete', ['master_list' => $masterList->id])}}" method="post">
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
                        No masterLists
                    </td>
                </tr>
            @endforelse
        </x-table-body>
        {!! $masterLists->links() !!}
    </div>
</x-dashboard.admin.base>
