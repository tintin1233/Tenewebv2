@props([
    'icon' => 'fi fi-rr-coins',
    'label' => 'sales',
    'total' => '123123213131',
    'hasCurrency' => false,
    'currency' => '₱'
])

<div class="w-full rounded-lg bg-white shadow-lg h-full flex flex-col justify-between border border-secondary p-2 gap-2">
    <div class="mt-2">
        <span class="p-2 rounded-lg bg-secondary text-accent">
            <i class="{{$icon}}"></i>
        </span>
    </div>
    <div class="flex flex-col gap-2 capitalize">
        <p class="text-xs text-gray-500">
            {{$label}}
        </p>
        <h1 class="text-3xl font-bold tracking-wider truncate">
          @if($hasCurrency)
            {{$currency}}
          @endif
          {{$total}}
        </h1>
    </div>



</div>
