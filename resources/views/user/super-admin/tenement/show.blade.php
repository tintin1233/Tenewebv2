@php
    use App\Enums\GeneralStatus;
@endphp

<x-dashboard.super-admin.base>
    <x-dashboard.page-label :back_url="route('super-admin.tenements.index')" title="tenement - {{ $tenement->name }}" />


    <div class="panel flex flex-col gap-2">
        <img src="{{ $tenement->image }}" alt="" srcset=""
            class="w-full object-cover object-center h-64 rounded-t-lg">
        <h1 class="text-3xl font-bold tracking-wider text-center">
            {{ $tenement->name }}
        </h1>
        <div class="p-2 flex flex-col gap-2">
            <div class="grid grid-cols-3 grid-flow-row gap-2 h-32">
                <x-card label="room" icon="fi fi-rr-bed-alt" total="{{ $tenement->rooms()->count() }}" />
                <x-card label="tenants" icon="fi fi-rr-family-dress"
                    total="{{ $tenement->activeTenants()->count() }}" />
                <x-card label="announcements" icon="fi fi-rr-megaphone"
                    total="{{ $tenement->announcements()->count() }}" />
            </div>

            <div class="flex gap-2">
                <div class="grow flex flex-col gap-2">
                    <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Units</h1>
                    <x-pie-chart />
                </div>
                <div class="grow flex flex-col gap-2">
                    <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Amortization</h1>
                    <x-line-chart />
                </div>
            </div>
        </div>
        @php
            $rooms = $tenement->rooms()->paginate(10);
        @endphp
        <div class="h-96 w-full overflow-y-auto flex flex-col gap-2">
            <h1 class="text-lg font-bold text-primary">Units</h1>
            <table class="table">
                <!-- head -->
                <thead class="bg-primary text-accent">
                    <tr>
                        <th></th>
                        <th>Unit No.</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->

                    @forelse ($rooms as $room)
                        <tr>
                            <th></th>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->status }}</td>
                            <td class="flex gap-2 justify-center">
                                <button onclick="document.getElementById('show_modal_{{ $room->id }}').showModal()"
                                    class="btn btn-accent btn-sm text-primary">
                                    <i class="fi fi-rr-eye"></i>
                                </button>

                                <!-- You can open the modal using ID.showModal() method -->

                                <dialog id="show_modal_{{ $room->id }}" class="modal">
                                    <div class="modal-box w-11/12 max-w-5xl">
                                        <div class="flex justify-between items-center my-2">
                                            <h3 class="text-lg font-bold">{{ $room->room_number }}</h3>
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                        </div>

                                        <div class="panel p-2 flex flex-col gap-2">
                                            <div class="grid grid-cols-4 grid-flow-row gap-2 h-32">
                                                <x-card />
                                                <x-card icon="fi fi-rr-house-chimney-user" label="tenant"
                                                    :total="$room->tenants()->count()" />
                                                <x-card label="Paid bills" icon="fi fi-rr-hand-bill"
                                                    :total="$room
                                                        ->bills()
                                                        ->where('status', GeneralStatus::PAID->value)
                                                        ->count()" />
                                                <x-card label="Unpaid bills" icon="fi fi-rr-hand-bill"
                                                    :total="$room
                                                        ->bills()
                                                        ->where('status', GeneralStatus::UNPAID->value)
                                                        ->count()" />
                                            </div>

                                            <div class="flex gap-2">
                                                <div class="grow flex flex-col gap-2">
                                                    <h1 class="text-lg font-bold text-primary">Sales</h1>
                                                    <x-pie-chart />
                                                </div>
                                                <div class="grow">
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


                                            @if ($tenant)
                                                <div class="bg-gray-100 rouded-lg flex gap-2 h-auto w-full p-2">
                                                    <div class="w-1/5  flex flex-col  gap-2">
                                                        <img src="{{ $tenant->user->profile->image }}"
                                                            class="w-full h-auto object-cover object-center" />
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
                                                                <p>{{ $tenant->user->profile->middle_name ?? 'N\A' }}
                                                                </p>
                                                            </div>
                                                            <div class="flex flex-col gap-2">
                                                                <h1 class="text-xs text-gray-500">Room Number</h1>
                                                                <p>{{ $tenant->room->room_number ?? 'N\A' }}</p>
                                                            </div>
                                                            <div class="flex flex-col gap-2">
                                                                <h1 class="text-xs text-gray-500">Move in Date</h1>
                                                                <p>{{ date('F d, Y', strtotime($tenant->move_in_date)) }}
                                                                </p>
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
                                                            <x-table-body :columns="['name', 'amount', 'type', 'status']" label="Bills">

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
                            <td class="flex gap-2 justify-center">
                                {{-- <a href="{{route('admin.tenants.show', ['tenant' => $tenant->id])}}" class="btn btn-accent btn-sm text-primary">
                                                                            <i class="fi fi-rr-eye"></i>
                                                                        </a> --}}
                                {{-- <a href="{{ route('admin.bills.edit', ['bill' => $bill->id]) }}"
                                    class="btn btn-secodary btn-sm text-primary">
                                    <i class="fi fi-rr-edit"></i>
                                </a>
                                <form action="{{ route('admin.bills.destroy', ['bill' => $bill->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-error btn-sm">
                                        <i class="fi fi-rr-trash"></i>
                                    </button>
                                </form> --}}
                            </td>
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

        <x-table-body :columns="['name', 'room number', 'Move in Date']" label="Previous Tenants">

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
    </dialog>

    {{-- <form action="#" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-error btn-sm">
                                    <i class="fi fi-rr-trash"></i>
                                </button>
                            </form> --}}
    </td>
    </tr>

@empty
    <tr>
        <th></th>
        <td>No Rooms</td>
    </tr>
    @endforelse
    </tbody>
    </table>
    </div>
    {!! $rooms->links() !!}
    </div>
</x-dashboard.super-admin.base>
