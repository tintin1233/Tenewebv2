<x-dashboard.super-admin.base>
    <x-dashboard.page-label :create_url="route('super-admin.tenements.create')" title="tenements" />

    <div class="grid grid-cols-3 grid-flow-row gap-2 h-32">
        <x-card label="Overall Collection" icon="fi fi-rr-peso-sign" :hasCurrency="true" total="{{ $totalSales }}" />
        <x-card label="Total Buildings" icon="fi fi-rr-building" total="{{ $totalBuilding }}" />
        <x-card label="Total Units" icon="fi fi-rr-bed-alt" total="{{ $totalUnits }}" />
    </div>

    <div class="panel p-2">



        @if (count($tenements) !== 0)
            <div class="grid grid-cols-4 grid-flow-row gap-2">

                @foreach ($tenements as $_tenement)
                    @if ($tenement->id !== $_tenement->id)
                        <a href="{{ route('super-admin.tenements.index', ['tenement' => $_tenement->id]) }}"
                            class="text-center capitalize text-primary font-bold py-2 ">
                            {{ $_tenement->name }}
                        </a>
                    @else
                        <a href="{{ route('super-admin.tenements.index', ['tenement' => $_tenement->id]) }}"
                            class="text-center capitalize text-accent font-bold py-2 bg-primary rounded-t-lg">
                            {{ $_tenement->name }}
                        </a>
                    @endif
                @endforeach
            @else
                <a class="text-center capitalize text-accent font-bold py-2 bg-primary rounded-t-lg">
                    No Tenements
                </a>
        @endif

        @if ($tenement)
    </div>
    @php

        $buildings = $tenement
            ->buildings()
            ->paginate(16)
            ->appends(['tenement' => $tenement->id]);

    @endphp

    <div class="grid grid-cols-4 grid-flow-row gap-2 border border-primary rounded-lg p-2">

        @foreach ($buildings as $building)
            <a href="{{ route('super-admin.buildings.show', ['building' => $building->id]) }}"
                class="btn btn-ghost btn-outline btn-primary text-accent" >
                    {{ $building->name }}
                </a>
 @endforeach

    </div>
    <div class="py-5">
        {!! $buildings->links() !!}
    </div>
@else
    <div class="min-h-32 w-full flex item-center justify-center gap-2 border border-primary rounded-lg p-2">
        <h1 class="font-bold text-lg text-primary">
            No Buildings
        </h1>
    </div>

    @endif


    {{-- @if (count($tenements) !== 0)
            <div class="grid grid-cols-2 grid-flow-row gap-5">
                @foreach ($tenements as $tenement)
                    <a href="{{route('super-admin.tenements.show', ['tenement' => $tenement->id])}}" class="h-full rounded-lg shadow-lg bg-white">
                        <img src="{{ $tenement->image }}" alt="" srcset=""
                            class="rounded-t-lg object-cover object-center h-44 w-full">
                        <div class="w-full flex flex-col gap-2 p-2">
                            <div class="w-full flex items-center justify-between">
                                <h1 class="text-2xl font-bold text-primary capitalize">{{ $tenement->name }}</h1>
                                <p class="text-xs text-secondary">
                                    Date : {{date('F d, Y', strtotime($tenement->created_at))}}
                                </p>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex flex-col gap-2">
                                    <h3 class="text-sm">Total Rooms</h3>
                                    <p class="text-xs text-secondary">{{ count($tenement->rooms) }}</p>
                                </div>
                                 <div class="flex flex-col gap-2">
                                    <h3 class="text-sm">Total Buildings</h3>
                                    <p class="text-xs text-secondary">{{ count($tenement->buildings) }}</p>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h3 class="text-sm">Announcements</h3>
                                    <p class="text-xs text-secondary">{{ count($tenement->announcements) }}</p>
                                </div>
                            </div>
                        </div>

                    </a>
                @endforeach
            </div>
        @else
            <div class="h-full flex justify-center items-center w-full bg-gray-100">
                <a href="{{ route('super-admin.tenements.create') }}" class="text-accent btn btn-xs btn-primary">Add
                    Tenement</a>
            </div>
        @endif --}}

    </div>
</x-dashboard.super-admin.base>
