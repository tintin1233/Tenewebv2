@php
    use App\Enums\GeneralStatus;
@endphp

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<x-dashboard.admin.base>
    <x-dashboard.page-label :back_url="route('admin.rooms.index')" :title="$room->room_number"/>


    <div class="panel p-2 flex flex-col gap-2">
        <div class="row">
            <div class="col-md-3 col-xs-6 col-sm-6">
            <x-card  />
            </div>
            <div class="col-md-3 col-xs-6 col-sm-6">
            <x-card icon="fi fi-rr-house-chimney-user" label="tenant" :total="$room->tenants()->count()" />
            </div>
            <div class="col-md-3 col-xs-6 col-sm-6">
            <x-card label="Paid bills" icon="fi fi-rr-hand-bill" :total="$room->bills()->where('status', GeneralStatus::PAID->value)->count()" />
            </div>
            <div class="col-md-3 col-xs-6 col-sm-6">
            <x-card label="Unpaid bills" icon="fi fi-rr-hand-bill" :total="$room->bills()->where('status', GeneralStatus::UNPAID->value)->count()" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-xs-12 col-sm-12">
                <h1 class="text-lg font-bold text-primary">Sales</h1>
                <x-pie-chart />
            </div>
            <div class="col-md-6 col-xs-12 col-sm-12">
                <h1 class="text-lg font-bold text-primary">Sales</h1>
                <x-line-chart />
            </div>
        </div>
    </div>

    @php
        $tenant = $room->tenants()->whereNull('move_out_date')->first();
    @endphp

    <div class="panel p-2 flex flex-col gap-2">

        <h1 class="text-lg font-bold text-primary">Current Tenant</h1>


        @if($tenant)

        <div class="bg-gray-100 rouded-lg flex gap-2 h-auto w-full p-2">
            <div class="w-1/5  flex flex-col  gap-2">
                <img src="{{$tenant->user->profile->image}}" class="w-full h-auto object-cover object-center" />
            </div>


            <div class="w-5/6 min-h-32 bg-gray-50 rounded-lg p-2">
                <h1 class="text-xl font-bold text-primary capitalize">
                    Personal Information
                </h1>

                <div class="grid grid-cols-3 grid-flow-row gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Last Name</h1>
                        <p>{{ $tenant->user->profile->last_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">First Name</h1>
                        <p>{{ $tenant->user->profile->first_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Middle Name</h1>
                        <p>{{ $tenant->user->profile->middle_name ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Room Number</h1>
                        <p>{{ $tenant->room->room_number ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Account Created</h1>
                        <p>{{ date('F d, Y', strtotime($tenant->move_in_date)) }}</p>
                    </div>

                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Gender</h1>
                        <p>{{ $tenant->user->profile->gender ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Contact</h1>
                        <p>{{ $tenant->user->profile->contact ?? 'N\A' }}</p>
                    </div>
                </div>



                <div class="flex flex-col gap-2 mt-5">
                    <x-table-body :columns="['Name', 'Amount', 'Type', 'Status']" :hideAction="true" label="Bills">

                        @forelse ($tenant->bills as $bill)
                            <tr>
                                <td></td>
                                <td>
                                    {{ $bill->name }}
                                </td>
                                <td>
                                    {{ $bill->amount }}
                                </td>
                                <td>
                                    {{ $bill->type }}
                                </td>
                                <td>
                                    {{ $bill->status }}
                                </td>
                                {{-- <td class="flex gap-2 justify-center"> --}}
                                    {{-- <a href="{{route('admin.tenants.show', ['tenant' => $tenant->id])}}" class="btn btn-accent btn-sm text-primary">
                                        <i class="fi fi-rr-eye"></i>
                                    </a> --}}
                                    {{-- <a href="{{route('admin.bills.edit', ['bill' => $bill->id])}}" class="btn btn-secodary btn-sm text-primary">
                                        <i class="fi fi-rr-edit"></i>
                                    </a>
                                    <form action="{{route('admin.bills.destroy', ['bill' => $bill->id])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-error btn-sm">
                                            <i class="fi fi-rr-trash"></i>
                                        </button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td> No Bills Data
                                    <td />
                            </tr>
                        @endforelse

                    </x-table-body>
                </div>
            </div>

        </div>

        @else

        <div class="w-full h-full flex justify-center items-center bg-gray-100 rounded-lg">
            <h1 class="text-lg font-bold text-primary">
                No Current Tenant
            </h1>
        </div>

        @endif

    </div>


    <div class="panel p-2">

        <x-table-body :columns="['Name', 'Unit Number', 'Date of Deletion ']" :hideAction="true" label="Previous Tenants" >

            @forelse ($room->tenants()->whereNotNull('move_out_date')->get() as $out_tenant)
                <tr>
                    <td>

                    </td>
                    <td class="capitalize">
                        {{ $out_tenant->user->profile->last_name }}, {{ $out_tenant->user->profile->first_name}}
                    </td>
                    <td>
                        {{ $out_tenant->room->room_number }}
                    </td>
                    <td>
                        {{ date('F d, Y', strtotime($out_tenant->move_in_date)) }}
                    </td>

                    {{-- <td class="flex gap-2 justify-center">
                        <a href="{{route('admin.tenants.show', ['tenant' => $out_tenant->user->id])}}" class="btn btn-accent btn-sm text-primary">
                            <i class="fi fi-rr-eye"></i>
                        </a> --}}
                        {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                            <i class="fi fi-rr-edit"></i>
                        </a> --}}
                        {{-- <form action="{{route('admin.tenants.destroy', ['tenant' => $out_tenant->user->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-error btn-sm">
                                <i class="fi fi-rr-trash"></i>
                            </button>
                        </form>
                    </td> --}}
                </tr>
            @empty
                <td>No Tenant</td>
            @endforelse
            <tr>
                <td></td>
            </tr>
        </x-table-body>
    </div>
</x-dashboard.admin.base>
