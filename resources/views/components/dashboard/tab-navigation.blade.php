@props([
    'tabs' => [
        [
            'url' => null,
            'label' => 'tab 1',
        ],
    ],
    'tab_number' => 2
])


<div class="grid grid-cols-{{$tab_number}} grid-flow-row gap-2">
    @foreach ($tabs as $tab)
        <a href="{{$tab['url'] !== '#' ? $tab['url'] : '#'}}" class="w-full flex justify-center p-2
        {{Route::is($tab['url']) !== null ? 'bg-primary text-accent' : 'hover:bg-primary hover:text-accent text-primary'}} font-bold  duration-700 rounded-lg capitalize">
            <h1>{{ $tab['label'] }}</h1>
        </a>
    @endforeach

</div>
