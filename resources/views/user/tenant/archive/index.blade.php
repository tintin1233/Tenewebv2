<x-dashboard.tenant.base>

    <div class="panel p-2 border-none shadow-none bg-none">
        <x-dashboard.page-label :title="__('Archived')" />


        <div class="min-h-screen w-full">
            <div class="panel p-2">

                <x-table-body :columns="['name', 'room number', 'Move in Date']" label="Previous Tenants" >

                    @forelse ($room->tenants()->whereNotNull('move_out_date')->get() as $tenant)
                        <tr>
                            <td>

                            </td>
                            <td>
                                {{ $tenant->name }}
                            </td>
                            <td>
                                {{ $tenant->tenant->room->room_number }}
                            </td>
                            <td>
                                {{ date('F d, Y', strtotime($tenant->tenant->move_in_date)) }}
                            </td>

                            <td class="flex gap-2 justify-center">
                                {{-- <a href="{{route('admin.tenants.show', ['tenant' => $tenant->id])}}" class="btn btn-accent btn-sm text-primary">
                                    <i class="fi fi-rr-eye"></i>
                                </a> --}}
                                {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                                    <i class="fi fi-rr-edit"></i>
                                </a> --}}
                                {{-- <form action="{{route('admin.tenants.destroy', ['tenant' => $tenant->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-error btn-sm">
                                        <i class="fi fi-rr-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @empty
                        <td>No Tenant</td>
                    @endforelse
                    <tr>
                        <td></td>
                    </tr>
                </x-table-body>
            </div>
        </div>


        {{-- <div class="grid grid-cols-2 grid-flow-row gap-5 h-32 mt-10"> --}}
            {{-- <a href="{{route('admin.archives.announcements.index')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Announcements
                </h1>
            </a> --}}
            {{-- <a class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Tenants
                </h1>
            </a> --}}
            {{-- <a href="{{route('admin.rooms.archives')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                   Units
                </h1>
            </a>
            <a href="{{route('admin.archives.comments.index')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Comments
                </h1>
            </a>
            <a href="{{route('admin.archives.payment-accounts.index')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Payment Accounts
                </h1>
            </a> --}}
            {{-- <a href="{{route('admin.archives.master-list.index')}}" class="flex items-center shadow-xl p-5 gap-5 hover:scale-105 duration-700 rounded-lg">

                <i class="fi fi-rr-folder-open text-primary text-5xl hover:text-secondary duration-700"></i>
                <h1 class="text-xl font-bold text-primary">
                    Master List
                </h1>
            </a> --}}
        {{-- </div> --}}
    </div>
</x-dashboard.tenant.base>
