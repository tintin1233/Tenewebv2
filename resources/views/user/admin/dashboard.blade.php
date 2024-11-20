@php
    $columns = ['Name', 'Email', 'Tenant Type', 'Unit No.', 'Tenement'];
@endphp

<x-dashboard.admin.base>

    <div class="min-h-screen w-full flex flex-col gap-2">
        <div class="grid grid-cols-4 grid-flow-row gap-2 min-h-32">
            <x-card label="Announcements" icon="fi fi-rr-megaphone"  :total="$totalAnnouncements"/>
            <x-card label="Collections" icon="fi fi-rr-peso-sign" :total="'₱ ' . $totalCollections"/>
            <x-card label="Tenants" icon="fi fi-rr-house-chimney-user" :total="$totalTenant" />
            {{-- <x-card label="Unverified Tenants" icon="fi fi-rr-house-chimney-user" :total="count($unverifiedTenants)" /> --}}
        </div>


        <div class="grid grid-cols-2 grid-flow-row gap-2">

            <div class="grow flex flex-col gap-2">
                <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Amortization</h1>
                <x-pie-chart :data_set="$billAmortization" />
            </div>

            <div class="grow flex flex-col gap-2">
                <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Dues</h1>
                <x-pie-chart :data_set="$billMonthlyDue" />
            </div>

        </div>


        {{-- <div class="panel p-2">
            <x-table-body label="Pre-Register Tenant" :columns="$columns">
                @forelse ($unverifiedTenants as $unTenant)
                    <tr>
                        <th></th>
                        <td>{{ $unTenant->name }}</td>
                        <td>{{ $unTenant->email }}</td>
                        <td>{{ $unTenant->tenant_type }}</td>
                        <td>{{ $unTenant->room_number }}</td>
                        <td>{{ $unTenant->tenement->name }}</td>
                        <td class="flex gap-2 justify-center">
                            <a href="{{ route('admin.unverified-tenant.show', ['unverified_tenant' => $unTenant->id]) }}"
                                class="btn btn-accent btn-sm text-primary">
                                View
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <th></th>
                        <td>No Pre-Register Tenants </td>
                    </tr>
                @endforelse

                {!! $unverifiedTenants->links() !!}
            </x-table-body>
        </div> --}}
    </div>





</x-dashboard.admin.base>
