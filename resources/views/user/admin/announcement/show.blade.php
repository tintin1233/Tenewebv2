<x-dashboard.admin.base>
    <x-dashboard.page-label title="Announcement" :back_url="route('admin.announcements.index')" />
    <div class="panel p-2 flex flex-col gap-2">
        <h1 class="py-10 text-3xl font-bold text-primary border-b border-gray-100 capitalize">
            {{ $announcement->title }}
        </h1>
        <div class="flex">
            <p class="text-xs text-gray-500">Posted On : {{ date('F d, Y', strtotime($announcement->created_at)) }}</p>
        </div>

        @if ($announcement->image)

            @php
                $fileExtension = pathinfo($announcement->image, PATHINFO_EXTENSION);

            @endphp

            @if (in_array($fileExtension, ['mp4', 'ogg', 'webm']))
                <div class="p-2 min-h-32 flex justify-center">
                    <video class="w-full aspect-auto" controls>
                        <source src="{{ $announcement->image }}" type="video/{{ $fileExtension }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                <a href="{{ $announcement->image }}" target="_blank">
                    <img src="{{ $announcement->image }}" alt="File Preview" class="object object-center">
                </a>
            @else
                <a href="{{ $announcement->image }}" target="_blank">Download File</a>
            @endif



            {{-- <a href="{{ $announcement->image }}">
                <div class="p-2 min-h-32 flex justify-center">
                    <img src="{{ $announcement->image }}" class="object-center h-auto w-full aspect-auto object-cover" />
                </div>
            </a> --}}
        @endif

        <p class="text-xs text-gray-500">
            {{ $announcement->title }}
        </p>


        <div class="rounded-lg p-2 min-h-32">
            {!! $announcement->description !!}
        </div>

        <div class="flex  flex-col gap-2" x-data="{ toggle: false }">
            <div class="border-y border-gray-200 p-2 flex  items-center gap-2  justify-between capitalize">
                <h1 class="input-generic-label flex items-center gap-2">
                    <span> Questions </span>
                    <span>{{ $announcement->announcementFeeds()->where('is_archived', false)->whereNull('reply_id')->count() }}</span>
                </h1>
                {{-- <button @click="toggle = !toggle" class="btn btn-primary text-accent btn-sm">
                    <span x-text="toggle ? 'Close' : 'Ask Question'" />
                </button> --}}
            </div>

            {{-- <div x-show="toggle" x-transition.duration.700ms>
                <form action="{{ route('tenant.announcement-feeds.store') }}" method="post"
                    class="flex flex-col gap-2">
                    @csrf
                    <x-quill-editor />

                    @if ($errors->has('descriptions'))
                        <p class="text-xs  text-error">{{ $errors->first('descriptions') }}</p>
                    @endif

                    <input type="hidden" name="announcement" value="{{ $announcement->id }}">
                    <button class="btn btn-sm btn-primary text-accent">Ask Questions</button>
                </form>
            </div> --}}
        </div>


        @forelse ($announcement->announcementFeeds()->where('is_archived', false)->whereNull('reply_id')->latest()->get() as $comment)
            <div class="border border-primary rounded-lg p-2 flex flex-col gap-2">
                <div class="flex items-center justify-between gap-5">
                    <div class="flex items-center gap-2">
                        <img src="{{ $comment->user->profile->image ?? "https://ui-avatars.com/api/?name={$comment->user->name}" }}"
                            alt="" srcset="" class="h-16 w-16 object-cover object-top rounded-full">
                    </div>

                    <div class="flex flex-col gap-2 bg-gray-100 rounded-lg p-2  grow" x-data="{ toggleId: null }">
                        <div class="flex justify-between items-center border-b border-gray-200">
                            <h1 class="capitalize font-bold">
                                <span>
                                    {{ $comment->user->profile->last_name }},
                                    {{ $comment->user->profile->first_name }}
                                </span>
                                <span class="text-xs text-gray-500"> -
                                    {{ $comment->user->tenant->room->room_number ?? 'N\A' }}</span>
                            </h1>

                            <p class="text-xs  text-gray-500">
                                {{ date('F d, Y', strtotime($comment->created_at)) }}
                            </p>
                        </div>

                        <div class="flex justify-between">
                            <div class="flex flex-col gap-2 grow">
                                {!! $comment->content !!}
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="btn btn-sm btn-primary text-accent"
                                    @click="toggleId = {{ $comment->id }}">Reply</button>
                                @if ($comment->user->id === Auth::user()->id)
                                    <button onclick="delete_modal_{{ $comment->id }}.showModal()"
                                        class="btn btn-error btn-sm">
                                        Delete
                                    </button>
                                @endif


                                <dialog id="delete_modal_{{ $comment->id }}" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <button
                                                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                        </form>
                                        <h3 class="text-lg font-bold">Delete Question </h3>
                                        <p class="py-4 text-xs">Press ESC key or click on ✕ button to close</p>
                                        <p class="text-lg py-2">Are Sure to delete your question ? </p>

                                        <div class="flex items-center gap-2 ">
                                            <form
                                                action="{{ route('tenant.announcement-feeds.destroy', ['announcement_feed' => $comment->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-success">Yes</button>
                                            </form>
                                            <form method="dialog">
                                                <button class="btn btn-error">Cancel</button>
                                            </form>
                                        </div>

                                    </div>
                                </dialog>
                            </div>
                        </div>
                        <div x-show="toggleId === {{ $comment->id }}" x-transition.duration.700ms>
                            <div class="flex justify-end">
                                <button class="btn btn-sm btn-error" @click="toggleId = null">Close</button>
                            </div>

                            <form action="{{ route('admin.comments.store') }}" method="post"
                                class="flex flex-col gap-2">
                                @csrf
                                <x-quill-editor />
                                <input type="hidden" name="parentId" value="{{ $comment->id }}">
                                <input type="hidden" name="commentType" value="reply">
                                @if ($errors->has('descriptions'))
                                    <p class="text-xs  text-error">{{ $errors->first('descriptions') }}</p>
                                @endif

                                <input type="hidden" name="announcement" value="{{ $announcement->id }}">
                                <button class="btn btn-sm btn-primary text-accent">reply Questions</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($comment->replies as $reply)
                <div class="border border-primary rounded-lg p-2 flex flex-col gap-2 ml-10">
                    <div class="flex items-center justify-between gap-5">
                        <div class="flex items-center gap-2">
                            <img src="{{ $reply->user->profile->image ?? "https://ui-avatars.com/api/?name={$reply->user->name}" }}"
                                alt="" srcset="" class="h-16 w-16 object-cover object-top rounded-full">
                        </div>

                        <div class="flex flex-col gap-2 bg-gray-100 rounded-lg p-2  grow" x-data="{ toggleId: null }">
                            <div class="flex justify-between items-center border-b border-gray-200">
                                <h1 class="capitalize font-bold">
                                    <span>
                                        {{ $reply->user->name }}
                                    </span>
                                    <span class="text-xs text-gray-500"> -
                                        {{ $reply->user->tenant->room->room_number ?? 'N\A' }}</span>
                                </h1>

                                <p class="text-xs  text-gray-500">
                                    {{ date('F d, Y', strtotime($reply->created_at)) }}
                                </p>
                            </div>

                            <div class="flex justify-between">
                                <div class="flex flex-col gap-2 grow">
                                    {!! $reply->content !!}
                                </div>
                                {{-- <div class="flex items-center gap-2">
                                <button class="btn btn-sm btn-primary text-accent" @click="toggleId = {{$reply->id}}">Reply</button>
                            </div> --}}
                                @if ($reply->user->id === Auth::user()->id)
                                    <button onclick="reply_modal_delete_{{ $reply->id }}.showModal()"
                                        class="btn btn-error btn-sm">
                                        Delete
                                    </button>
                                @endif
                                <dialog id="reply_modal_delete_{{ $reply->id }}" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <button
                                                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                        </form>
                                        <h3 class="text-lg font-bold">Delete Question </h3>
                                        <p class="py-4 text-xs">Press ESC key or click on ✕ button to close</p>
                                        <p class="text-lg py-2">Are Sure to delete your question ? </p>

                                        <div class="flex items-center gap-2 ">
                                            <form
                                                action="{{ route('admin.comments.destroy', ['comment' => $reply->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-success">Yes</button>
                                            </form>
                                            <form method="dialog">
                                                <button class="btn btn-error">Cancel</button>
                                            </form>
                                        </div>

                                    </div>
                                </dialog>
                            </div>
                            <div x-show="toggleId === {{ $reply->id }}" x-transition.duration.700ms>
                                <div class="flex justify-end gap-2">
                                    <button class="btn btn-sm btn-error" @click="toggleId = null">Close</button>

                                </div>

                                <form action="{{ route('admin.comments.store') }}" method="post"
                                    class="flex flex-col gap-2">
                                    @csrf
                                    <x-quill-editor />
                                    <input type="hidden" name="parentId" value="{{ $reply->id }}">
                                    <input type="hidden" name="commentType" value="reply">
                                    @if ($errors->has('descriptions'))
                                        <p class="text-xs  text-error">{{ $errors->first('descriptions') }}</p>
                                    @endif

                                    <input type="hidden" name="announcement" value="{{ $announcement->id }}">
                                    <button class="btn btn-sm btn-primary text-accent">reply Questions</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @empty
            <div class="border border-primary rounded-lg p-2 flex items-center justify-center ">
                <h1 class="text-primary text-sm font-semibold">No Questions</h1>
            </div>
        @endforelse


    </div>
</x-dashboard.admin.base>
