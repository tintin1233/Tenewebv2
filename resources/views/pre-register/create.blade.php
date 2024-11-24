
<style>
  /* Mobile view adjustments */
  @media (max-width: 768px) {
    .shadow-lg  {
        width: 100% !important;
        margin-top:2vh;
        margin-bottom:2vh;
    }
  }

    /* Hide the content on mobile screens */
  /* Additional adjustments for very small screens, if needed */
  @media (max-width: 480px) {
    .shadow-lg  {
        width: 100% !important;
        margin-top:2vh;
        margin-bottom:2vh;
    }
}

</style>
<x-landing-page.base>
    <div class="w-full h-full flex justify-center items-center">
        <div class="w-2/4 h-auto bg-white shadow-lg rounded-lg p-5 flex flex-col gap-2">
            <x-notification-message />
            <div class="w-full flex justify-center py-2 border-b border-primary ">

                <div class="flex gap-2">
                    {{-- <img src="{{asset('')}}" alt="" srcset=""> --}}
                    <h1 class="text-2xl font-bold text-primary ">Register</h1>
                </div>

            </div>

            <form action="" method="POST" class="flex flex-col gap-2 h-full w-full " enctype="multipart/form-data">
                @csrf   
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
                <div class="flex flex-col gap-2">
                    <h1 class="input-generic-label">Tenant Type</h1>
                    <select name="tenant_type" class="select select-primary w-full select-sm text-sm">
                        <option disabled selected>Select Tenant Type</option>
                        <option value="new tenant">New Tenant</option>
                        <option value="old tenant">Old Tenant</option>
                    </select>
                    <x-dashboard.input-error :errors="$errors" name="tenant_type" />
                </div>
                <div class="flex flex-col gap-2" x-data="getRoomByTenement">
                    <h1 class="input-generic-label">Tenement</h1>
                    <select name="tenement" x-model.debounce.500ms="tenementId"
                        class="select select-primary w-full select-sm text-sm">
                        <option selected>Select Tenement</option>

                        @foreach ($tenements as $tenement)
                            <option value="{{ $tenement->id }}">{{ $tenement->name }}</option>
                        @endforeach

                    </select>
                    <x-dashboard.input-error :errors="$errors" name="email" />
                    <h1 class="input-generic-label">Unit No.</h1>
                    <template x-if="isLoading">
                        <img src="{{ asset('images/loader/loading-buffering.gif') }}" alt="" srcset=""
                            class="object-cover object-center w-full h-20">
                    </template>
                    <template x-if="!isLoading">
                        <select name="room_number" class="select select-primary w-full select-sm text-sm">
                            <option disabled selected>Select Unit</option>
                            <template x-for="room in rooms" :key="room.id">
                                <option :value="room.room_number">
                                    <span x-text="room.room_number"></span>
                                </option>
                            </template>
                        </select>
                    </template>
                    <x-dashboard.input-error :errors="$errors" name="room_number"  />
                </div>
                <h1>Basic Information</h1>
                <div class="grid grid-cols-3 grid-flow-row gap-2">
                    <div class="flex flex-col gap-2">
                        <h1 class="input-generic-label">Last Name</h1>
                        <input type="text" name="last_name" class="input-generic">
                        <x-dashboard.input-error :errors="$errors" name="last_name"  />

                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="input-generic-label">First Name</h1>
                        <input type="text" name="first_name" class="input-generic">
                        <x-dashboard.input-error :errors="$errors" name="first_name"  />

                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="input-generic-label">Middle Name</h1>
                        <input type="text" name="middle_name" class="input-generic">
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
                        <x-dashboard.input-error :errors="$errors" name="contact_no"  />

                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="input-generic-label">Profile</h1>
                        <p class="text-xs text-gray-400">Format (png)</p>
                        <input type="file" name="image" class="file-input file-input-primary file-input-sm">
                    </div>

                    <div class="flex flex-col gap-2">
                        <h1 class="input-generic-label">Document</h1>
                        <p class="text-xs text-gray-400">Format (png)</p>
                        <input type="file" name="document" class="file-input file-input-primary file-input-sm">
                        <x-dashboard.input-error :errors="$errors" name="document"  />
                    </div>
                    

                    <button class="btn btn-sm btn-primary text-accent">Submit</button>
            </form>
        </div>
    </div>




</x-landing-page.base>
