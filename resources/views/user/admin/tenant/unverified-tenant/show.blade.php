<x-dashboard.admin.base>

    <x-dashboard.page-label :back_url="route('admin.unverified-tenant.index')" title="Pre Register Tenant" />

    <div class="panel p-2">
        <div class="flex gap-2 h-full w-full">
            <div class="w-1/5 h-full flex flex-col gap-2">
                <img src="{{$unverifiedTenant->image}}"  class="h-64 w-38 object-cover" />
                <h1 class="text-center font-bold capitalize text-lg">{{$unverifiedTenant->tenant_type}}</h1>
                <h1 class="text-center font-bold">{{$unverifiedTenant->email}}</h1>
            </div>

            <div class="bg-gray-50 rounded-lg flex flex-col gap-2 w-5/6 p-2 h-full justify-between">
                <h1 class="text-primary text-xl font-bold text-center">Personal Information</h1>
                <div class="grid grid-cols-3 grid-flow-row gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Last Name</h1>
                        <p>{{$unverifiedTenant->last_name}}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">First Name</h1>
                        <p>{{$unverifiedTenant->first_name}}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Middle Name</h1>
                        <p>{{$unverifiedTenant->middle_name ?? "N\A"}}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Room Number</h1>
                        <p>{{$unverifiedTenant->room_number ?? "N\A"}}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Tenant Type</h1>
                        <p>{{$unverifiedTenant->tenant_type ?? "N\A"}}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Tenement</h1>
                        <p>{{$unverifiedTenant->tenement->name ?? "N\A"}}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Gender</h1>
                        <p>{{$unverifiedTenant->gender ?? "N\A"}}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Contact</h1>
                        <p>{{$unverifiedTenant->contact ?? "N\A"}}</p>
                    </div>
                </div>


                <div class="w-full flex gap-2 justify-end">
                    <form action="{{route('admin.unverified-tenant.store')}}" method="post">
                        @csrf

                        <input type="hidden" name="unverifiedTenantId" value="{{$unverifiedTenant->id}}">
                        <button class="btn btn-xs btn-accent">Accept</button>
                    </form>
                    <form action="{{route('admin.unverified-tenant.destroy', ['unverified_tenant' => $unverifiedTenant->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-xs btn-error">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard.admin.base>
