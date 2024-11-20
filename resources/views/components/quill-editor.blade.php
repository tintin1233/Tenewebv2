@props([
    'height' => 10,
    'width' => "100%"
])

<div x-data="textEditor" class="h-auto w-full">
    <div x-ref="editor" style="width : {{$width}}; height : {{$height}}rem;">
        {{$slot}}
    </div>

    <input type="hidden" name="descriptions" x-model="descriptions" />
</div>
