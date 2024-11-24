
<style>
    .table{
        width:100% !important;
    }
</style>
<style>
@media (max-width: 768px) {
    .text-2xl {
        font-size:1.5vh !important;
    }
    .input-generic-label{
        font-size:1vh !important;
    }
}
</style><x-dashboard.admin.base>


    <x-notification-message />


    <div class="panel p-2" style="overflow-x:auto !important;">
        <x-table-body :columns="['Last Name', 'First Name', 'Middle Name', 'Room Number', 'Date and Time']"
         label="Master Lists"

         >

            @forelse ($masterLists as $masterList)
                <tr>
                    <td>

                    </td>
                    <td>
                        {{ $masterList->last_name }} 
                    </td>
                    <td>

                    </td>
                    <td>
                        {{ $masterList->first_name }}
                    </td>
                    <td>

                    </td>
                    <td>
                        {{ $masterList->middle_name ?? 'N\A' }}
                    </td>
                    <td>

                    </td>
                    <td>
                        {{ $masterList->room_number }}
                    </td>
                    <td>

                    </td>
                    <td>
                        {{$masterList->created_at->format('F d, Y h:s A')}}
                    </td>

                    <td>

                    </td>
                    <td class="flex gap-2 justify-center">
                        <a href="{{route('admin.master-list.show', ['master_list' => $masterList->id])}}" class="btn btn-accent btn-sm text-primary">
                            View
                        </a>
                       {{-- <a href="{{route('admin.master-list.edit', ['master_list' => $masterList->id])}}" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}
                        {{-- <form action="{{route('admin.master-list.destroy', ['master_list' => $masterList->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-error btn-sm">
                                <i class="fi fi-rr-trash"></i>
                            </button>
                        </form> --}}
                    </td>
                </tr>
            @empty
                <td>No Master List</td>
            @endforelse
            <tr>
                <td></td>
            </tr>

            {!! $masterLists->links() !!}
        </x-table-body>
    </div>
</x-dashboard.admin.base>
