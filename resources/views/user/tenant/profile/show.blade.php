<x-dashboard.tenant.base>


    <x-notification-message />

    <x-dashboard.page-label :back_url="route('tenant.dashboard')" title="Tenant" />


    <div class="panel p-2">
        <div class="flex gap-2">
            <div class="w-1/5 flex  flex-col gap-2">
                <img src="{{ $tenant->profile->image }}" alt="" srcset="" class="w-full h-64 object-cover">
                <h1 class="text-center text-lg font-bold capitalize text-primary">
                    {{ "{$tenant->profile->last_name}, {$tenant->profile->first_name}" }}
                </h1>
                <h1 class="text-center text-xs font-semibold text-gray-500">
                    {{ $tenant->email }}
                </h1>
            </div>
            <div class="w-5/6 min-h-32 bg-gray-50 rounded-lg p-2">
                <div class="flex justify-between">
                    <h1 class="text-xl font-bold text-primary capitalize">
                        Personal Information
                    </h1>
                    <h1 class="text-xl font-bold text-primary capitalize text-center">
                        Family Composition
                    </h1>
                    <h1>

                    </h1>
                </div>


                <div class="grid grid-cols-3 grid-flow-row gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Last Name</h1>
                        <p>{{ $tenant->profile->last_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">First Name</h1>
                        <p>{{ $tenant->profile->first_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Middle Name</h1>
                        <p>{{ $tenant->profile->middle_name ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Room Number</h1>
                        <p>{{ $tenant->tenant->room->room_number ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Move in Date</h1>
                        <p>{{ date('F d, Y', strtotime($tenant->tenant->move_in_date)) }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Tenement</h1>
                        <p>{{ $tenant->tenant->room->tenement->name ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Gender</h1>
                        <p>{{ $tenant->profile->gender ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Contact</h1>
                        <p>{{ $tenant->profile->contact ?? 'N\A' }}</p>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-2">
                    <h1 class="text-xl font-bold text-primary capitalize">
                        Family Member
                    </h1>

                    <button onclick="add_family_modal.showModal()" class="btn btn-accent btn-sm">
                        + Add Family
                    </button>
                </div>


                <div class="flex flex-col gap-2 mt-2">
                    <x-table-body :columns="['name', 'status', 'Date of Birth', 'Relationship with Head']" label="">
                        @foreach ($tenant->familyMembers as $family)
                            <tr>
                                <td></td>
                                <td>{{ $family->name }}</td>
                                <td>{{ $family->status }}</td>
                                <td>{{ $family->birthdate }}</td>
                                <td>{{ $family->relationship }}</td>
                                <td class="flex gap-2 justify-center">
                                    <button
                                        onclick="document.getElementById('show_modal_{{ $family->id }}').showModal()"
                                        class="btn btn-accent btn-sm text-primary">
                                        <i class="fi fi-rr-eye"></i>
                                    </button>

                                    <dialog id="show_modal_{{ $family->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h3 class="text-lg font-bold">Family Member - {{ $family->name }}</h3>
                                            <div class="flex flex-col gap-2">
                                                <h1 class="text-xs text-gray-500">Name</h1>
                                                <p>{{ $family->name }}</p>
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <h1 class="text-xs text-gray-500">Status</h1>
                                                <p>{{ $family->status }}</p>
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <h1 class="text-xs text-gray-500">Date of Birth</h1>
                                                <p>{{ $family->birthdate }}</p>
                                            </div>
                                            <div class="flex flex-col gap-2">
                                                <h1 class="text-xs text-gray-500">Relationship with Head</h1>
                                                <p>{{ $family->relationship }}</p>
                                            </div>
                                        </div>
                                    </dialog>
                                    <button
                                        onclick="document.getElementById('edit_modal_{{ $family->id }}').showModal()"
                                        class="btn btn-secodary btn-sm text-primary">
                                        <i class="fi fi-rr-edit"></i>
                                    </button>
                                    <dialog id="edit_modal_{{ $family->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h3 class="text-lg font-bold">EditFamily</h3>
                                            <form action="{{ route('tenant.family-members.store') }}" method="post"
                                                class="flex flex-col gap-2">
                                                @csrf
                                                <div class="flex flex-col gap-2">
                                                    <h1 class="input-generic-label">Name</h1>
                                                    <input type="text" name="name" class="input-generic"
                                                        value="{{ $family->name }}">
                                                    @error('name')
                                                        <p class="text-xs text-error">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col gap-2">
                                                    <h1 class="input-generic-label">Status</h1>
                                                    <input type="text" name="status" class="input-generic"
                                                        value="{{ $family->status }}">
                                                    @error('status')
                                                        <p class="text-xs text-error">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col gap-2">
                                                    <h1 class="input-generic-label">Date of Birth</h1>
                                                    <input type="date" name="date_of_birth" class="input-generic"
                                                        value="{{ $family->birthdate }}">
                                                    @error('date_of_birth')
                                                        <p class="text-xs text-error">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>
                                                <div class="flex flex-col gap-2">
                                                    <h1 class="input-generic-label">Relationship with Head</h1>
                                                    <input type="text" name="relationship_with_head"
                                                        value="{{ $family->relationship }}" class="input-generic">
                                                    @error('relationship_with_head')
                                                        <p class="text-xs text-error">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>


                                                <div class="flex justify-end gap-2">
                                                    <button class="btn btn-accent">Update</button>
                                                </div>

                                            </form>
                                        </div>
                                    </dialog>
                                    <button onclick="document.getElementById('delete_modal_{{ $family->id }}').showModal()"
                                        class="btn btn-error btn-sm">
                                        <i class="fi fi-rr-trash"></i>
                                    </button>
                                    <dialog id="delete_modal_{{ $family->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <h1 class="text-lg font-bold">
                                                Delete
                                            </h1>
                                            <p>Are you sure to delete this data ?</p>
                                            <div class="flex items-center gap-2 mt-10">
                                                <form
                                                    action="{{ route('tenant.family-members.destroy', ['family_member' => $family->id]) }}"
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
                        @endforeach


                    </x-table-body>

                    <!-- You can open the modal using ID.showModal() method -->

                    <dialog id="add_family_modal" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="text-lg font-bold">Add Family</h3>
                            <form action="{{ route('tenant.family-members.store') }}" method="post"
                                class="flex flex-col gap-2">
                                @csrf
                                <div class="flex flex-col gap-2">
                                    <h1 class="input-generic-label">Name</h1>
                                    <input type="text" name="name" class="input-generic">
                                    @error('name')
                                        <p class="text-xs text-error">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h1 class="input-generic-label">Status</h1>
                                    <input type="text" name="status" class="input-generic">
                                    @error('status')
                                        <p class="text-xs text-error">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h1 class="input-generic-label">Date of Birth</h1>
                                    <input type="date" name="date_of_birth" class="input-generic">
                                    @error('date_of_birth')
                                        <p class="text-xs text-error">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h1 class="input-generic-label">Relationship with Head</h1>
                                    <input type="text" name="relationship_with_head" class="input-generic">
                                    @error('relationship_with_head')
                                        <p class="text-xs text-error">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>


                                <div class="flex justify-end gap-2">
                                    <button class="btn btn-accent">Add</button>
                                </div>

                            </form>
                        </div>
                    </dialog>
                </div>

                {{-- <div class="flex flex-col gap-2 mt-5">
                    <x-table-body :columns="['name', 'amount', 'type', 'status']" label="Bills" :create_url="route('admin.bills.create', ['tenant' => $tenant->id])">

                        @forelse ($tenant->tenant->bills as $bill)
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
                                    <a href="#" class="btn btn-accent btn-sm text-primary">
                                        <i class="fi fi-rr-eye"></i>
                                    </a>
                                     <a href="{{ route('admin.bills.edit', ['bill' => $bill->id]) }}"
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
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td> No Bills Data
                                    <td />
                            </tr>
                        @endforelse

                    </x-table-body>
                </div> --}}
            </div>

        </div>
    </div>
    </x-dashboard.admin.base>
