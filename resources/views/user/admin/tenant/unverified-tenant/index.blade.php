<x-dashboard.admin.base>
    <div class="grid grid-cols-2 grid-flow-row gap-2 h-32">
        <a href="{{route('admin.tenants.index')}}" class="w-full h-full">
            <x-card label="tenants" icon="fi fi-rr-house-chimney-user" :total="$tenants" />
        </a>
        <a href="#" class="w-full h-full">
            <x-card label="Pre Register Tenants" icon="fi fi-rr-house-chimney-user" :total="count($unverifiedTenants)" />
        </a>
    </div>


    <div class="panel p-2">
        <x-table-body :columns="[
            'name',
            'email',
            'tenant type',
            'room number',
            'last name',
            'first name',
            'middle name',
            'contact',
            'tenement'
        ]"  label="Pre Register Tenant" >

            @forelse ($unverifiedTenants as $unverifiedTenant)
                <tr>
                    <td></td>
                    <td>
                        {{$unverifiedTenant->name}}
                    </td>
                    <td>
                        {{$unverifiedTenant->email}}
                    </td>
                    <td>
                        {{$unverifiedTenant->tenant_type}}
                    </td>
                    <td>
                        {{$unverifiedTenant->room_number}}
                    </td>
                    <td>
                        {{$unverifiedTenant->last_name}}
                    </td>
                    <td>
                        {{$unverifiedTenant->first_name}}
                    </td>
                    <td>
                        {{$unverifiedTenant->middle_name ?? "N\A"}}
                    </td>
                    <td>
                        {{$unverifiedTenant->contact ?? "N\A"}}
                    </td>
                    <td>
                        {{$unverifiedTenant->tenement->name}}
                    </td>

                    <td class="flex gap-2 justify-center">
                        <a href="{{route('admin.unverified-tenant.show', ['unverified_tenant' => $unverifiedTenant->id])}}"
                            class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a>
                        {{-- <a href="#"
                            class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}
                        <form action="#" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-error btn-sm">
                                <i class="fi fi-rr-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <td>No Tenant</td>
            @endforelse
            <tr>
                <td></td>
            </tr>

            {!! $unverifiedTenants->links() !!}
        </x-table-body>
    </div>
</x-dashboard.admin.base>
