<x-dashboard.tenant.base>

    <div class="panel p-2">
        <x-table-body label="Announcements" :columns="[
            'Title',
            'Date and Time Posted',
        ]" >

                <tr>
                    <td></td>
                    <td class="capitalize">1
                    </td>
                    <td></td>
                    <td>2
                    </td>
                    <td></td>
                    <td></td>
                    <td class="flex gap-2 justify-center">3
                    </td>
                </tr>
            @forelse ($announcements as $announcement)
                <tr class="{{!$announcement->viewedByAuthUser($announcement->id) ? 'font-bold' : ''}}">
                    <td></td>
                    <td class="capitalize">
                        {{ $announcement->title}}
                    </td>
                    <td>
                        {{$announcement->created_at->format('F d, Y h:s A')}}
                    </td>
                    <td class="flex gap-2 justify-center">
                        <a href="{{route('tenant.announcements.show', ['announcement' => $announcement->id])}}" class="btn btn-accent btn-sm text-primary">
                            View
                        </a>
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
</x-dashboard.tenant.base>
