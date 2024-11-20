<x-dashboard.admin.base>

    <div class="panel p-2">
        <x-table-body label="Archived - Announcements" :columns="['Title', 'Date & time Posted']"
        >
            @forelse ($announcements as $announcement)
                <tr>
                    <td></td>
                    <td>
                        {{ $announcement->title }}
                    </td>
                    <td>
                        {{ $announcement->created_at->format('F d, Y h:s A') }}
                    </td>
                    <td class="flex gap-2 justify-center">
                        {{-- <a href="{{route('admin.announcements.show', ['announcement' => $announcement->id])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a> --}}
                        <a href="{{ route('admin.announcements.restore', ['announcement' => $announcement->id]) }}"
                            class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-time-past"></i>
                        </a>

                        <!-- Open the modal using ID.showModal() method -->
                        <button class="btn btn-sm btn-error" onclick="document.getElementById('my_modal_{{ $announcement->id }}').showModal()"> <i class="fi fi-rr-trash"></i></button>
                        <dialog id="my_modal_{{$announcement->id}}" class="modal">
                            <div class="modal-box">
                                <h3 class="text-lg font-bold">Are you Sure ? </h3>
                                <p class="py-4">Data will permanently Deleted!</p>

                                <div class="modal-action">
                                    <form action="{{route('admin.announcements.delete', ['announcement' => $announcement->id])}}" method="post">
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
                        No Announcements
                    </td>
                </tr>
            @endforelse
        </x-table-body>
        {!! $announcements->links() !!}
    </div>
</x-dashboard.admin.base>
