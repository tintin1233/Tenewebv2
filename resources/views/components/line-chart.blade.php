@props([
    'data_set' => null,
    'title' => null,
])

<div class="w-full h-full" x-data="lineChart">

    @if($data_set)
    <div x-ref="chart" x-init="updateData({{json_encode($data_set)}}, `{{$title}}`)" />
    @else

    <div x-ref="chart" />

    @endif
</div>
