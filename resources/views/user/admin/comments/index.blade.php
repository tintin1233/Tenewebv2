<x-dashboard.admin.base>

    <div class="panel p-2">
        <x-table-body label="Comments" :columns="[
            'Content',
            'Announcement',
            'Tenant',
            'Date and Time',
        ]" >
            @forelse ($comments as $comment)


                <tr>

                    <td></td>
                    <td class="truncate w-52">
                        {!! $comment->content!!}
                    </td>
                    <td>
                        {{ $comment->announcement->title}}
                    </td>
                    <td>
                        {{ $comment->user->name}}
                    </td>
                    <td>
                        {{$comment->created_at->format("F d, Y h:s A")}}
                    </td>
                    <td class="flex gap-2 justify-center">
                       <a href="{{route('admin.comments.show', ['comment' => $comment->id])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        {{-- <a href="{{route('admin.comments.edit', ['comment' => $comment->id])}}" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}
                        

                        <button class="btn btn-error btn-sm" onclick="document.getElementById('delete_modal_{{$comment->id}}').showModal()">
                            <i
                                class="fi fi-rr-trash"></i></button>



                        <dialog id='delete_modal_{{$comment->id}}' class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Delete Data</h3>
                                
                                <p class="py-4">Are you sure to delete the data ?</p>
                                <div class="flex items-center justify-end gap-2">
                                    <form
                                    action="{{ route('admin.comments.destroy', ['comment' => $comment->id]) }}"
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
                <tr>
                    <td>
                        No comments
                    </td>
                </tr>
            @endforelse
        </x-table-body>
        {!! $comments->links() !!}
    </div>
</x-dashboard.admin.base>
