@props([
    'columns' => ['name', 'Email', 'Tenement'],
    'label' => 'sample table',
    'create_url' => null,
    'archived_url' => null,
    'search_url' => null,
    'hideAction' => false,
    'useLabelWithOptions' => false,
    'labelOptionsName' => 'label with options',
    'options' => [
        [
            'url' => '#',
            'name' => 'option 1',
        ],
        [
            'url' => '#',
            'name' => 'option 2',
        ],
    ],
])

<div class="w-full h-auto flex flex-col gap-2">
    <div class="w-full flex  items-center justify-between">
        <div class="flex items-center gap-2">
            @if (!$useLabelWithOptions)
                <h1 class="text-2xl font-bold text-primary">{{ $label }}</h1>
            @else
                <div x-data="{ open: false }">
                    <button x-ref="button" @click="open = !open">
                        <h1 class="text-2xl font-bold text-primary">{{ $labelOptionsName }}</h1>
                    </button>

                    <div x-show="open" class="flex flex-col gap-2 bg-white z-10 p-4 shadow-lg " x-anchor="$refs.button">

                        @foreach ($options as $option)
                        <a href="{{ $option['url'] }}"
                        class="p-2 hover:bg-primary rounded-lg hover:text-accent capitalize duration-700 hover:scale-105">
                         {{$option['name']}} </a>

                        @endforeach



                    </div>
                </div>
            @endif

            @if (isset($additionalLabel))
                {{ $additionalLabel }}
            @endif
        </div>

        <div class="flex items-center space-x-2">
            @if ($archived_url)
                <a href="{{ $archived_url }}" class="btn btn-sm btn-gray-200 text-primary">
                    <span>
                        <i class="fi fi-rr-box"></i>
                    </span>
                    <span>
                        Archived
                    </span>
                </a>
            @endif

            <div class="flex items-center gap-2">
                @if ($search_url)
                    <form method="get" action="{{ $search_url }}">

                        <div class="flex items-center gap-2">
                            <input type="text" class="input input-accent input-sm" name="search"
                                placeholder="search....">
                            <button class="btn btn-accent btn-sm">Search</button>
                        </div>

                    </form>
                @endif

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

        </div>

    </div>

    <div class="overflow-y-auto">
        <table class="table">
            <!-- head -->
            <thead class="bg-primary text-accent">
                <tr>
                    <th></th>
                    @foreach ($columns as $column)
                        <th colspan="2">{{ $column }}</th>
                    @endforeach
                    @if (!$hideAction)
                        <th class="text-center">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
