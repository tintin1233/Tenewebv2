
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<x-dashboard.super-admin.base>

    <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-12">
        <x-card label="overall collections" :hasCurrency="true" :total="$totalSales" />
        </div>
        <div class="col-md-6 col-xs-12 col-sm-12">
        <x-card label="tenants" icon="fi fi-rr-house-chimney-user" :total="$tenantTotal" />
        </div>
        <div class="col-md-6 col-xs-12 col-sm-12">
        <x-card label="tenements" icon="fi fi-rr-house-building" :total="$tenementTotal" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="w-full h-96 bg-white rounded-lg shadow-lg border border-secondary">

            <div x-data="lineChart" class="w-full min-h-32" x-init="updateData({{ json_encode($amortizationDataSet) }}, 'Monthly Amortization')">
                <div x-ref="chart">

                </div>
            </div>
        </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="w-full h-96 bg-white rounded-lg shadow-lg border border-secondary">

            <div x-data="lineChart" class="w-full min-h-32" x-init="updateData({{ json_encode($monthlyDueDataSet) }}, 'Monthly Dues')">
                <div x-ref="chart">

                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="grid grid-cols-4 grid-flow-row gap-2">
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

    <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-12">
        <div class="grow flex flex-col gap-2">
            <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Amortization</h1>
            <x-pie-chart :data_set="$billAmortization" />
        </div>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-12">
        <div class="grow flex flex-col gap-2">
            <h1 class="text-lg text-accent bg-primary rounded-t-lg p-2">Monthly Dues</h1>
            <x-pie-chart :data_set="$billMonthlyDue" />
        </div>
        </div>



    </div>

</x-dashboard.super-admin.base>
