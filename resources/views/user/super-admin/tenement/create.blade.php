<style>
    .text-3xl {
        font-size:2vh;
    }
</style>
<x-dashboard.super-admin.base>
    <x-dashboard.page-label :back_url="route('super-admin.tenements.index')" title="Tenenement Create" />

    <x-notification-message />
    <div class="panel">
        <form action="{{ route('super-admin.tenements.store') }}" method="post" class="flex flex-col gap-2 w-full p-2"
            enctype="multipart/form-data">
            @csrf
            <h1 class="text-secondary font-bold">Image</h1>
            <div class="w-full h-auto flex justify-center" x-data="imagePreview">
                <template x-if="imageSrc">
                    <div class="flex items-center justify-center w-5/6">
                        <img :src="imageSrc" alt="" srcset="" class="object-center w-full h-auto">
                    </div>
                </template>
                <div class="flex items-center justify-center w-5/6" x-show="!imageSrc">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2
                        border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50
                        ">
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
                        <input id="dropzone-file" name="image" @change="uploadImageHandler($event)" type="file"
                            class="hidden" />
                    </label>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Name</h1>
                <input type="text" name="name" id="" class="input-generic">
            </div>
            {{-- <div class="flex flex-col gap-2 h-64" x-data="textEditor">
                <h1 class="input-generic-label">Description</h1>
                <div x-ref="editor">

                </div>
                <input type="hidden" name="description" x-model="descriptions">

            </div> --}}

            <div class="grid grid-cols-2 grid-flow-row gap-2">
                <div class="flex flex-col gap-2">
                    <h1 class="input-generic-label">Number of Buildings</h1>
                    <input type="number" name="number_of_buildings" id="" class="input-generic">
                </div>
                <div class="flex flex-col gap-2">
                    <h1 class="input-generic-label">Number of Units</h1>
                    <input type="number" name="number_of_units" id="" class="input-generic">
                </div>
            </div>
            <button class="btn btn-sm btn-primary text-accent" @click="getContent">Add</button>
        </form>
    </div>
</x-dashboard.super-admin.base>
