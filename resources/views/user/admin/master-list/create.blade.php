<x-dashboard.admin.base>
    <x-notification-message />

    <x-dashboard.page-label :back_url="route('admin.master-list.index')" title="Add Master List" />

    <div class="panel p-2">
        <form action="{{route('admin.master-list.store')}}" method="post" class="w-full h-full flex flex-col gap-2" enctype="multipart/form-data">
            @csrf

            <div class="flex gap-5">
                <div class="flex flex-col gap-2 w-1/2">
                    <div class="flex items-center justify-center w-full" x-data="imagePreview">

                        <template x-if="!imageSrc">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full
                    h-64 border-2 border-gray-300 border-dashed rounded-lg
                     cursor-pointer bg-gray-50  hover:bg-gray-100 ">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 " aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 "><span class="font-semibold">Click
                                            to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 ">SVG, PNG, JPG or GIF (MAX. 800x400px)
                                    </p>
                                </div>

                            </label>

                        </template>
                        <input id="dropzone-file" type="file" name="image"
                        @change="uploadImageHandler($event)" class="hidden" />
                        <template x-if="imageSrc">
                            <div class="flex flex-col gap-2 rounded-lg h-32 w-5/6 p-5">
                                <img :src="imageSrc" alt="" srcset="" class="w-full aspect-auto">
                            </div>
                        </template>
                    </div>

                    @if ($errors->has('image'))
                        <p class="text-xs text-error">{{ $errors->first('image') }}</p>
                    @endif
                </div>

                <div class="flex flex-col gap-2">
                    <div class="grid grid-cols-3 grid-flow-row gap-2">
                        <div class="flex flex-col gap-2">
                            <h1 class="input-generic-label">Last Name</h1>
                            <input type="text" name="last_name" class="input-generic"">
                            @if ($errors->has('last_name'))
                                <p class="text-xs text-error">{{ $errors->first('last_name') }}</p>
                            @endif
                        </div>


                        <div class="flex flex-col gap-2">
                            <h1 class="input-generic-label">First Name</h1>
                            <input type="text" name="first_name" class="input-generic"">
                            @if ($errors->has('first_name'))
                                <p class="text-xs text-error">{{ $errors->first('first_name') }}</p>
                            @endif

                        </div>


                        <div class="flex flex-col gap-2">
                            <h1 class="input-generic-label">Middle Name</h1>
                            <input type="text" name="middle_name" class="input-generic"">
                            @if ($errors->has('middle_name'))
                                <p class="text-xs text-error">{{ $errors->first('middle_name') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="input-generic-label">Age</h1>
                        <input type="number" name="age" class="input-generic"">
                        @if ($errors->has('age'))
                            <p class="text-xs text-error">{{ $errors->first('age') }}</p>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="input-generic-label">Room</h1>

                        <select name="room" class="select select-primary w-full select-sm text-sm">
                            <option disabled selected>Select Room</option>
                            @foreach ($rooms as $room)
                                <option value="{{$room->room_number}}">{{$room->room_number}}</option>
                            @endforeach

                        </select>
                        @if ($errors->has('room'))
                            <p class="text-xs text-error">{{ $errors->first('room') }}</p>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="input-generic-label">Gender</h1>

                        <select name="gender" class="select select-primary w-full select-sm text-sm">
                            <option disabled selected>Select Gender</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                        @if ($errors->has('gender'))
                            <p class="text-xs text-error">{{ $errors->first('gender') }}</p>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="input-generic-label">Contact No.</h1>
                        <input type="number" name="contact_no" class="input-generic"">
                        @if ($errors->has('contact_no'))
                            <p class="text-xs text-error">{{ $errors->first('contact_no') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <button class="btn btn-sm btn-primary text-accent">Submit</button>
        </form>
    </div>
</x-dashboard.admin.base>
