<x-dashboard.super-admin.base>


    <x-notification-message />
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
</style>
    <div class="panel p-2" style="overflow-x:auto !important;">
        <x-table-body :columns="['Last Name', 'First Name', 'Middle Name', 'Bldg No. & Unit No.', 'Tenement',  'Date and Time']" label="Master Lists"
        :create_url="route('super-admin.master-list.create')"
        :search_url="route('super-admin.master-list.index')"
        >

        <x-slot name="additionalLabel">
            <div class="ml-5 divide-x-2 divide-gray-800 gap-5 flex items-center ">
                @foreach ($tenements as $_tenement)
                @if ($tenement->id !== $_tenement->id)
                        <a href="{{ route('super-admin.master-list.index', ['tenement' => $_tenement->id]) }}"
                            class="text-center capitalize text-primary font-bold p-2">
                            {{ $_tenement->name }}
                        </a>
                    @else
                        <a href="{{ route('super-admin.master-list.index', ['temement' => $_tenement->id]) }}"
                            class="text-center capitalize text-accent font-bold p-2 bg-primary rounded-lg">
                            {{ $_tenement->name }}
                        </a>
                    @endif
            @endforeach
            </div>

        </x-slot>

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
                        {{ $masterList->tenement->name }}
                    </td>
                    <td>

                    </td>
                    <td>
                        {{ $masterList->created_at->format('F d, Y h:s A') }}
                    </td>

                    <td class="flex gap-2 justify-center">
                        <a href="{{ route('super-admin.master-list.show', ['master_list' => $masterList->id]) }}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        <a href="{{ route('super-admin.master-list.edit', ['master_list' => $masterList->id]) }}"
                            class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a>


                        {{-- <button class="btn btn-error btn-sm" onclick="document.getElementById('delete_modal_{{$masterList->id}}').showModal()">
                            <i
                                class="fi fi-rr-trash"></i></button>



                        <dialog id='delete_modal_{{$masterList->id}}' class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Delete Data</h3>

                                <p class="py-4">Are you sure to delete the data ?</p>
                                <div class="flex items-center justify-end gap-2">
                                    <form
                                    action="{{ route('super-admin.master-list.destroy', ['master_list' => $masterList->id]) }}"
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
                        </dialog> --}}

                    </td>
                </tr>
            @empty
                <td>No masterList</td>
            @endforelse
            <tr>
                <td></td>
            </tr>

            {!! $masterLists->links() !!}
        </x-table-body>
    </div>
</x-dashboard.super-admin.base>
