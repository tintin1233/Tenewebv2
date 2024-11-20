@props([
    'errors' => null,
    'name' => null
])

@if ($errors->first($name))
<p class="text-error text-xs">{{$errors->first($name)}}</p>
@endif
