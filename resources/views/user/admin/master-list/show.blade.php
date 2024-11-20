<x-dashboard.admin.base>


    <x-notification-message />

    <x-dashboard.page-label :back_url="route('admin.master-list.index')" title="masterList" />

    <div class="panel p-2">
        <div class="flex gap-2">
            <div class="w-1/5 flex  flex-col gap-2">
                <img src="{{ $masterList->image }}" alt="" srcset="" class="w-full h-64 object-cover">
                <h1 class="text-center text-lg font-bold capitalize text-primary">
                    {{ "{$masterList->last_name}, {$masterList->first_name}" }}
                </h1>
                <h1 class="text-center text-xs font-semibold text-gray-500">
                    {{ $masterList->email }}
                </h1>
            </div>
            <div class="w-5/6 min-h-32 bg-gray-50 rounded-lg p-2">
                <div class="flex items-center justify-between">

                    <h1 class="text-xl font-bold text-primary capitalize">
                        Personal Information
                    </h1>

                    <button class="btn btn-sm btn-accent" onclick="my_modal_4.showModal()">Create Account</button>
                    <dialog id="my_modal_4" class="modal">
                        <div class="modal-box w-11/12 max-w-5xl">
                            <div class="modal-action">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                  </form>
                            </div>
                            <div class="w-full flex justify-center py-2 border-b border-primary ">

                                <div class="flex gap-2">
                                    {{-- <img src="{{asset('')}}" alt="" srcset=""> --}}
                                    <h1 class="text-2xl font-bold text-primary ">Generate Account</h1>
                                </div>

                            </div>

                            <form action="{{route('admin.master-list.generate-account')}}" method="POST" class="flex flex-col gap-2 h-full w-full " enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="master_list_id" value="{{$masterList->id}}">
                                <div class="flex flex-col gap-2">
                                    <h1 class="input-generic-label">Name</h1>
                                    <input type="text" name="name" class="input-generic">
                                    <x-dashboard.input-error :errors="$errors" name="name" />
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h1 class="input-generic-label">Email</h1>
                                    <input type="text" name="email" class="input-generic">
                                    <x-dashboard.input-error :errors="$errors" name="email" />
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h1 class="input-generic-label">Password</h1>
                                    <input type="password" name="password" class="input-generic">
                                    <x-dashboard.input-error :errors="$errors" name="password" />
                                </div>


                                <h1>Basic Information</h1>
                                <div class="grid grid-cols-3 grid-flow-row gap-2">
                                    <div class="flex flex-col gap-2">
                                        <h1 class="input-generic-label">Last Name</h1>
                                        <input type="text" name="last_name" value="{{ $masterList->last_name }}" class="input-generic">
                                        <x-dashboard.input-error :errors="$errors" name="last_name"  />

                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <h1 class="input-generic-label">First Name</h1>
                                        <input type="text" name="first_name" value="{{ $masterList->first_name}}" class="input-generic">
                                        <x-dashboard.input-error :errors="$errors" name="first_name"  />

                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <h1 class="input-generic-label">Middle Name</h1>
                                        <input type="text" name="middle_name" class="input-generic" value="{{ $masterList->middle_name ?? 'N\A'}}">
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h1 class="input-generic-label">Address</h1>
                                    <input type="text" name=address" class="input-generic">
                                    <x-dashboard.input-error :errors="$errors" name="middle_name"  />

                                </div>
                                <div class="flex flex-col gap-2">
                                    <h1 class="input-generic-label">Gender</h1>
                                    <select name="gender"
                                        class="select select-primary w-full select-sm text-sm">
                                        <option disabled selected>Select Gender</option>


                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <x-dashboard.input-error :errors="$errors" name="gender"  />

                                </div>
                                    <div class="flex flex-col gap-2">
                                        <h1 class="input-generic-label">Contact</h1>
                                        <input type="number" name="contact_no" class="input-generic">
                                        <x-dashboard.input-error :errors="$errors" name="contact_no" />

                                    </div>


                                    <button class="btn btn-sm btn-primary text-accent">Submit</button>
                            </form>
                        </div>
                    </dialog>
                </div>


                <div class="grid grid-cols-3 grid-flow-row gap-5">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Last Name</h1>
                        <p>{{ $masterList->last_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">First Name</h1>
                        <p>{{ $masterList->first_name }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Middle Name</h1>
                        <p>{{ $masterList->middle_name ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Blg No. & Unit No.</h1>
                        <p>{{ $masterList->room_number ?? 'N\A' }}</p>
                    </div>
                    {{-- <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Move in Date</h1>
                        <p>{{ date('F d, Y', strtotime($masterList->masterList->move_in_date)) }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Tenement</h1>
                        <p>{{ $masterList->masterList->room->tenement->name ?? 'N\A' }}</p>
                    </div> --}}
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Gender</h1>
                        <p>{{ $masterList->gender ?? 'N\A' }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-xs text-gray-500">Contact</h1>
                        <p>{{ $masterList->contact_no ?? 'N\A' }}</p>
                    </div>
                </div>




            </div>

        </div>
    </div>
</x-dashboard.admin.base>
