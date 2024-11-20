<x-dashboard.super-admin.base>


    <x-notification-message />
    <x-dashboard.page-label title="Create Announcement" :back_url="route('super-admin.announcements.index')" />

    <div class="panel p-2 flex flex-col gap-2">

        <form action="{{ route('super-admin.announcements.store') }}" enctype="multipart/form-data" method="post" class="flex flex-col gap-2 w-full h-full">
            @csrf
            <div class="flex flex-col gap-2">
                <h1 class="input-generic-label">Title</h1>
                <input type="text" name="title" class="input-generic">

                @if ($errors->has('title'))
                    <p class="text-xs text-error">
                        {{ $errors->first('title') }}
                    </p>
                @endif
            </div>
            <div class="min-h-32 w-full flex  flex-col gap-2">
                <h1 class="input-generic-label">Descriptions</h1>
                <x-quill-editor />

                @if ($errors->has('descriptions'))
                    <p class="text-xs text-error">
                        {{ $errors->first('descriptions') }}
                    </p>
                @endif
            </div>

            <div class="flex flex-col gap-2" x-data="mediaPreview">

                <template x-if="mediaData.format === 'image'">
                    <div class="flex items-center justify-center">
                        <img :src="mediaData.src" alt="" srcset="" class="w-1/2 aspect-auto">
                    </div>

                </template>
                <template x-if="mediaData.format === 'video'">
                    <div class="flex items-center justify-center">
                        <video class="w-1/2 aspact-auto" controls autoplay="false">
                            <source :src="mediaData.src" type="video/mp4">

                            Your browser does not support the video tag.
                          </video>
                    </div>

                </template>

                <h1 class="input-generic-label">Upload Media (<span class="text-xs text-gray-500">Jpeg, mp4</span>)</h1>
                <input type="file" name="media" @change="uploadMediaHandler($event)" class="file-input file-input-sm file-input-primary">

                @if ($errors->has('media'))
                    <p class="text-xs text-error">
                        {{ $errors->first('media') }}
                    </p>
                @endif
            </div>

            <button class="btn btn-sm btn-primary text-accent">
                Post
            </button>
        </form>


    </div>
</x-dashboard.super-admin.base>
