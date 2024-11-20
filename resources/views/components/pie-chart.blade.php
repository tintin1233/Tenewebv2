@props([
    'data_set' => null
])
<div class="w-full h-full" x-data="pieChart">
    @if($data_set)

    <div x-ref="chart" class="h-full w-full" x-init="updateDataSeries({{json_encode($data_set)}})">

    </div>

    @else
    <div x-ref="chart" class="h-full w-full">

    </div>
    @endif

</div>
