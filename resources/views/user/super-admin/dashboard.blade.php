<x-dashboard.super-admin.base>
    <div class="grid grid-cols-3 grid-flow-row gap-5 h-32">
        <x-card label="overall collections" :hasCurrency="true" :total="$totalSales" />
        <x-card label="tenants" icon="fi fi-rr-house-chimney-user" :total="$tenantTotal" />
        <x-card label="tenements" icon="fi fi-rr-house-building" :total="$tenementTotal" />
    </div>

    <div class="grid grid-cols-2 grid-flow-row w-full gap-2">
        <div class="w-full h-96 bg-white rounded-lg shadow-lg border border-secondary">

            <div x-data="lineChart" class="w-full min-h-32" x-init="updateData({{ json_encode($amortizationDataSet) }}, 'Monthly Amortization')">
                <div x-ref="chart">

                </div>
            </div>
        </div>
        <div class="w-full h-96 bg-white rounded-lg shadow-lg border border-secondary">

            <div x-data="lineChart" class="w-full min-h-32" x-init="updateData({{ json_encode($monthlyDueDataSet) }}, 'Monthly Dues')">
                <div x-ref="chart">

                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-5 grid-flow-row gap-2">
        @foreach ($tenements as $_tenement)
            @if ($tenement->id !== $_tenement->id)
                <a href="{{ route('super-admin.dashboard', ['tenement' => $_tenement->id]) }}"
                    class="text-center capitalize text-primary font-bold py-2 ">
                    {{ $_tenement->name }}
                </a>
            @else
                <a href="{{ route('super-admin.dashboard', ['tenement' => $_tenement->id]) }}"
                    class="text-center capitalize text-accent font-bold py-2 bg-primary rounded-t-lg">
                    {{ $_tenement->name }}
                </a>
            @endif
        @endforeach
    </div>

    <div class="grid grid-cols-2 grid-flow-row gap-2">

        <div class="grow flex flex-col gap-2">
            <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Amortization</h1>
            <x-pie-chart :data_set="$billAmortization" />
        </div>

        <div class="grow flex flex-col gap-2">
            <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Dues</h1>
            <x-pie-chart :data_set="$billMonthlyDue" />
        </div>

    </div>

</x-dashboard.super-admin.base>
