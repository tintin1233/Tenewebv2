<x-dashboard.super-admin.base>
    <x-dashboard.page-label :back_url="route('super-admin.users.index')" title="tenants" />


    <div class="panel flex flex-col gap-2 p-2">
        <div class="grid grid-cols-{{count($tenements)}} grid-flow-row gap-2">
            @foreach ($tenements as $_tenement)
                <a href="{{route('super-admin.users.tenants.index', ['tenement' => $_tenement->id])}}" class="w-full flex justify-center p-2
                {{ $tenement->id === $_tenement->id ? 'bg-primary text-accent' : 'hover:bg-primary hover:text-accent text-primary'}} font-bold  duration-700 rounded-lg capitalize">
                    <h1>{{ $_tenement->name }}</h1>
                </a>
            @endforeach

        </div>

        <div class="h-96 w-full overflow-y-auto flex flex-col gap-2">
            <h1 class="text-lg font-bold text-primary"></h1>
            <table class="table">
                <!-- head -->
                <thead class="bg-primary text-accent">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Unit No. </th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- row 1 -->

                    @forelse ($tenants as $tenant)
                        <tr>
                            <th></th>
                            <td class="capitalize">{{ $tenant->user->profile->last_name }}, {{ $tenant->user->profile->first_name }}
                            </td>
                            <td>{{ $tenant->room->room_number }}</td>
                            <td class="flex gap-2 justify-center">

                                <!-- You can open the modal using ID.showModal() method -->


                                <button onclick="document.getElementById('my_modal_{{ $tenant->id }}').showModal()"
                                    class="btn btn-accent btn-sm text-primary">
                                    <i class="fi fi-rr-eye"></i>
                                </button>


                                <dialog id="my_modal_{{ $tenant->id }}" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <button
                                                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                        </form>

                                        <p class="py-1"></p>

                                        <div class="flex gap-2 flex-col">
                                            <div class="w-full flex  flex-col gap-2">

                                                @if ($tenant->user->profile->image)
                                                    <img src="{{ $tenant->user->profile->image }}" alt=""
                                                        srcset="" class="w-full h-64 object-cover">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ $tenant->user->profile->last_name }}+{{ $tenant->user->profile->first_name }}+ {{ $tenant->user->profile->middle_name }}"
                                                        alt="" srcset="" class="w-full h-64 object-cover">
                                                @endif

                                                <h1 class="text-center text-lg font-bold capitalize text-primary">
                                                    {{ "{$tenant->user->profile->last_name}, {$tenant->user->profile->first_name}
                                                    {$tenant->user->profile->middle_name}" }}
                                                </h1>
                                                <h1 class="text-center text-xs font-semibold text-gray-500">
                                                    Email: {{ $tenant->user->email }}
                                                </h1>
                                            </div>
                                            <div class="w-5/6 min-h-32 bg-gray-60 rounded-lg p-2">
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
                                                        <p>{{ date('F d, Y', strtotime($tenant->move_in_date)) }}
                                                        </p>
                                                    </div>
                                                    <div class="flex flex-col gap-2">
                                                        <h1 class="text-xs text-gray-500">Tenement</h1>
                                                        <p>{{ $tenant->room->tenement->name ?? 'N\A' }}</p>
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

                                            </div>
                                        </div>


                                </dialog>


                                <!-- You can open the modal using ID.showModal() method -->
                                <button class="btn btn-error btn-sm"
                                    onclick="document.getElementById('delete_modal_{{ $tenant->id }}').showModal()">
                                    <i class="fi fi-rr-trash"></i></button>
                                <dialog id="delete_modal_{{ $tenant->id }}" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                        </form>
                                        <h3 class="text-lg font-bold">Delete Data</h3>

                                        <p class="py-4">Are you sure to delete the data ?</p>
                                        <div class="flex items-center justify-end gap-2">
                                            <form
                                            action="{{ route('super-admin.users.tenants.destroy', ['tenant' => $tenant->user->id]) }}"
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
                            <td>No Tenants</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard.super-admin.base>
