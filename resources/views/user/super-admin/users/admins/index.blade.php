@php
    $links = [[
        'url' => route('super-admin.users.admins.index'),
        'label' => "all"
    ]];


    foreach ($tenements as $tenement) {
        $links[] = [
            'url' => route('super-admin.users.admins.index', ['tenement' => $tenement->id]),
            'label' => "admins - {$tenement->name}",
        ];
    }
@endphp


<x-dashboard.super-admin.base>
    <x-dashboard.page-label :back_url="route('super-admin.users.index')" title="admins" :create_url="route('super-admin.users.admins.create')" />


    <div class="panel flex flex-col gap-2 p-2">
        <x-dashboard.tab-navigation tab_number="3" :tabs="$links" />
        <div class="h-96 w-full overflow-y-auto flex flex-col gap-2">
            <h1 class="text-lg font-bold text-primary"></h1>
            <table class="table">
                <!-- head -->
                <thead class="bg-primary text-accent">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phase No.</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->

                    @forelse ($admins as $admin)
                        <tr>
                            <th></th>
                            <td>{{ $admin->name }}</td>
                            <td>{{$admin->email}}</td>
                            <td>{{$admin->adminProfile->tenement->name}}</td>
                            <td class="flex gap-2 justify-center">
                                <a href="{{ route('super-admin.users.admins.show', ['admin' => $admin->id]) }}"
                                    class="btn btn-accent btn-sm text-primary">
                                    <i class="fi fi-rr-eye"></i>
                                </a>
                                <a href="{{ route('super-admin.users.admins.edit', ['admin' => $admin->id]) }}"
                                    class="btn btn-secodary btn-sm text-primary">
                                    <i class="fi fi-rr-edit"></i>
                                </a>
                                

                        <button class="btn btn-error btn-sm" onclick="document.getElementById('delete_modal_{{$admin->id}}').showModal()">
                            <i
                                class="fi fi-rr-trash"></i></button>



                        <dialog id='delete_modal_{{$admin->id}}' class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                <h3 class="text-lg font-bold">Delete Data</h3>
                                
                                <p class="py-4">Are you sure to delete the data ?</p>
                                <div class="flex items-center justify-end gap-2">
                                    <form
                                    action="{{ route('super-admin.users.admins.destroy', ['admin' => $admin->id]) }}"
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
                            <th></th>
                            <td>No Admins</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard.super-admin.base>
