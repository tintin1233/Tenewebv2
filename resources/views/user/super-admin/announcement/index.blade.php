<x-dashboard.super-admin.base>

<style>
/* Responsive Design */
@media (max-width: 768px) {
    .text-primary{
        font-size:1.5vh;
    }
}
</style>
    <div class="panel p-2">
        <x-table-body label="Announcements" :columns="['Title', 'Date & time Posted', 'Created By']" :create_url="route('super-admin.announcements.create')"> 
            <tr>
                    <td></td>
                    <td>1
                    </td>
                    <td>2
                    </td>
            </tr>
            @forelse ($announcements as $announcement)
                <tr>
                    <td></td>
                    <td>
                        {{ $announcement->title }}
                    </td>
                    <td>
                        {{ $announcement->created_at->format('F d, Y h:s A') }}
                    </td>
                    <td>
                        {{ $announcement->user->name }}
                    </td>
                    <td class="flex gap-2 justify-center">
                        <a href="{{ route('super-admin.announcements.show', ['announcement' => $announcement->id]) }}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>

                        @if ($announcement->user->id === Auth::user()->id)
                            <a href="{{ route('super-admin.announcements.edit', ['announcement' => $announcement->id]) }}"
                                class="btn btn-secodary btn-sm text-primary">
                                <i class="fi fi-rr-edit"></i>
                            </a>
                        @endif
                        {{-- <a href="{{route('admin.announcements.edit', ['announcement' => $announcement->id])}}" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a>
                        <form action="{{route('admin.announcements.destroy', ['announcement' => $announcement->id])}}" method="post">
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
</x-dashboard.super-admin.base>
