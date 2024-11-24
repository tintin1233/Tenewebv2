<x-dashboard.tenant.base>


<style>
/* Responsive Design */
@media (max-width: 768px) {
    .text-3xl{
        font-size:2vh !important;
    }
}
</style>
    <x-notification-message />

    <x-dashboard.page-label :back_url="route('tenant.dashboard')" title="Family Composition" />


    <div class="panel p-2">
        <div class="flex gap-2 flex-col">

                {{--<div class="flex justify-center">
                    <h1 class="text-xl font-bold text-primary capitalize text-center">
                        Family Composition
                    </h1>
                </div>--}}


                <div class="flex justify-between items-center mt-2">
                    <h1 class="text-xl font-bold text-primary capitalize">
                        Family Member
                    </h1>

                    <button onclick="add_family_modal.showModal()" class="btn btn-accent btn-sm">
                        + Add Family
                    </button>
                </div>


                <div class="flex flex-col gap-2 mt-2">
                    <x-table-body :columns="['Name', 'Status', 'Date of Birth', 'Relationship with Head']" label="">
                        @foreach ($familyMembers as $family)
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
                                            <h3 class="text-lg font-bold">Edit Family</h3>
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
                                                    <button class="btn btn-accent">Save</button>
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
                                            Data Deletion Confirmation
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


            </div>

        </div>
    </div>
    </x-dashboard.admin.base>
