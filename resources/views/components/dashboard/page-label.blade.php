@props([
    'title' => 'Sample',
    'create_url' => null,
    'back_url' => null,
])

<div class="w-full flex items-center justify-between">
    <div class="flex items-center gap-2">
        @if ($back_url)
            <a href="{{ $back_url }}" class="btn btn-accent btn-sm text-primary">
                <i class="fi fi-rr-arrow-small-left"></i>
            </a>
        @endif

        <h1 class="text-3xl font-bold capitalize tracking-widest text-primary">
            {{ $title }}
        </h1>
    </div>

    @if ($create_url)
        <a href="{{ $create_url }}" class="btn btn-sm btn-primary text-accent">
            <span>
                <i class="fi fi-rr-add"></i>
            </span>
            <span>
                Create
            </span>
        </a>
    @endif

</div>
