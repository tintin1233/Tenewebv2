<x-dashboard.admin.base>
<style>
/* Responsive Design */
@media (max-width: 768px) {
    .text-primary{
        font-size:1.5vh;
    }
}
</style>
    <div class="panel p-2">
        <x-table-body label="Announcements" :columns="['Title', 'Date & Time Posted', 'Created By']" :create_url="route('admin.announcements.create')">
            @forelse ($announcements as $announcement)
                <tr class="{{ $announcement->unapproved_count !== 0 ? 'font-bold' : ' ' }}">
                    <td></td>
                    <td>

                        @if ($announcement->unapproved_count !== 0)
                            <span class="text-xs px-2 py bg-error rounded-full">
                                {{ $announcement->unapproved_count }}</span>
                        @endif
                        {{ $announcement->title }}
                    </td>
                    <td></td>
                    <td>
                        {{ $announcement->created_at->format('F d, Y h:s A') }}
                    </td>
                    <td></td>
                    <td>
                        {{ $announcement->user->name }}
                    </td>
                    <td></td>
                    <td class="flex gap-2 justify-center">
                        <a href="{{ route('admin.announcements.show', ['announcement' => $announcement->id]) }}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>

                        @if ($announcement->user->id === Auth::user()->id)
                            <a href="{{ route('admin.announcements.edit', ['announcement' => $announcement->id]) }}"
                                class="btn btn-secodary btn-sm text-primary">
                                <i class="fi fi-rr-edit"></i>
                            </a>

                            <button class="btn btn-error btn-sm"
                                onclick="document.getElementById('delete_modal_{{ $announcement->id }}').showModal()">
                                <i class="fi fi-rr-trash"></i></button>
                        @endif

                        <dialog id='delete_modal_{{ $announcement->id }}' class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Data Deletion Confirmation</h3>

                                <p class="py-4">Are you sure to delete this Announcement ?</p>
                                <div class="flex items-center justify-end gap-2">
                                    <form
                                        action="{{ route('admin.announcements.destroy', ['announcement' => $announcement->id]) }}"
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
                        No Announcements
                    </td>
                </tr>
            @endforelse
        </x-table-body>
        {!! $announcements->links() !!}
    </div>
</x-dashboard.admin.base>
