@php
    $columns = ['Name', 'Email', 'Tenant Type', 'Unit No.', 'Tenement'];
@endphp
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .bg-primary {
    --tw-bg-opacity: 1;
    background-color: var(--fallback-p, oklch(var(--p) / var(--tw-bg-opacity))) !important;
}
</style>
<x-dashboard.admin.base>

    <div class="min-h-screen w-full flex flex-col gap-2">
        <div class="row">
            <div class="col-md-4 col-xs-12 col-sm-12">
            <x-card label="Announcements" icon="fi fi-rr-megaphone"  :total="$totalAnnouncements"/>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-12">
            <x-card label="Collections" icon="fi fi-rr-peso-sign" :total="'₱ ' . $totalCollections"/>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-12">
            <x-card label="Tenants" icon="fi fi-rr-house-chimney-user" :total="$totalTenant" />
            </div>
            {{-- <x-card label="Unverified Tenants" icon="fi fi-rr-house-chimney-user" :total="count($unverifiedTenants)" /> --}}
        </div>


        <div class="row">

            <div class="col-md-6 col-xs-12 col-sm-12">
                <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Amortization</h1>
                <x-pie-chart :data_set="$billAmortization" />
            </div>

            <div class="col-md-6 col-xs-12 col-sm-12">
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
