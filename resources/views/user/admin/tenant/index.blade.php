<x-dashboard.admin.base>


    <x-notification-message />

    <div class="grid grid-cols-2 grid-flow-row gap-2 h-32">
        <a href="{{ route('admin.tenants.index') }}" class="w-full h-full">
            <x-card label="tenants" icon="fi fi-rr-house-chimney-user" :total="count($tenants)" />
        </a>
        <a href="{{ route('admin.unverified-tenant.index') }}" class="w-full h-full">
            <x-card label="Pre Register Tenants" icon="fi fi-rr-house-chimney-user" :total="$unverifiedTenantTotal" />
        </a>
    </div>


<style>
    @media (max-width: 768px) {
        .text-2xl {
            display: none;
        }
    }
</style>
    <div class="panel p-2">
        <x-table-body :columns="['Name', 'Bldg No. & Unit No.', 'Account Created']" :search_url="route('admin.tenants.index')" label="Tenants" >

            @forelse ($tenants as $tenant)
                <tr>
                    <td>

                    </td>
                    <td>
                        {{ $tenant->profile->last_name }}, {{$tenant->profile->first_name}}
                    </td>
                    <td>
                        {{ $tenant->tenant->room->room_number }}
                    </td>
                    <td>
                        {{ date('F d, Y', strtotime($tenant->tenant->move_in_date)) }}
                    </td>

                    <td class="flex gap-2 justify-center">

                        <button class="btn btn-warning btn-sm" onclick="move_out_modal_{{$tenant->id}}.showModal()">
                            <i class="fi fi-rr-exit-alt"></i>
                        </button>


                        <dialog id='move_out_modal_{{$tenant->id}}' class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Move out ?</h3>

                                <p class="py-4">Are you sure you want to move out this tenant ?</p>
                                <div class="flex items-center justify-end gap-2">
                                    <form
                                    action="{{ route('admin.tenants.move_out', ['tenant' => $tenant->id]) }}"
                                    method="post">
                                    @csrf
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


                        <a href="{{route('admin.tenants.show', ['tenant' => $tenant->id])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}


                        <button class="btn btn-error btn-sm" onclick="document.getElementById('delete_modal_{{$tenant->id}}').showModal()">
                            <i
                                class="fi fi-rr-trash"></i></button>



                        <dialog id='delete_modal_{{$tenant->id}}' class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Delete Data</h3>

                                <p class="py-4">Are you sure to delete the data ?</p>
                                <div class="flex items-center justify-end gap-2">
                                    <form
                                    action="{{ route('admin.tenants.destroy', ['tenant' => $tenant->id]) }}"
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
                <td>No Tenant</td>
            @endforelse
            <tr>
                <td></td>
            </tr>

            {!! $tenants->links() !!}
        </x-table-body>
    </div>
</x-dashboard.admin.base>
