<x-dashboard.super-admin.base>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <x-notification-message />

    <div class="panel p-2">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-primary">Revenue</h1>


        </div>
<style>
    .bg-primary {
    --tw-bg-opacity: 1;
    background-color: var(--fallback-p, oklch(var(--p) / var(--tw-bg-opacity))) !important;
}.bg-secondary {
    --tw-bg-opacity: 1;
    background-color: var(--fallback-s, oklch(var(--s) / var(--tw-bg-opacity))) !important;
}
</style>

        <div class="min-h-screen flex flex-col gap-2">
            <div class="w-full flex justify-center">
                <h1 class="flex items-center text-xl font-bold gap-5"> <span>
                        <img src="{{ asset('logo.png') }}" alt="" class="w-12 aspect-square rounded-full"></span>
                    <span style="font-size:2vh;">
                        CUIDAD DE STRIKE HOMEOWNERS ASSOCIATION, INC
                        <p class="font-thin text-xs text-center">Molino Road, Molino 1, Bacoor City</p>
                    </span>

                </h1>
            </div>




            <div class="row">
                <div class="col-md-3 col-xs-6 col-sm-12">
                <x-card label="revenue" :has_currency="true" icon="fi fi-rr-peso-sign" :total="$totalRevenue" />
                </div>
                <div class="col-md-3 col-xs-6 col-sm-12">
                <x-card label="total amortilization" :has_currency="true" icon="fi fi-rr-peso-sign" :total="$totalAmortization" />
                </div>
                <div class="col-md-3 col-xs-6 col-sm-12">
                <x-card label="total Monthly Dues" :has_currency="true" icon="fi fi-rr-peso-sign" :total="$totalMonthlyDue" />
                </div>
                <div class="col-md-3 col-xs-6 col-sm-12">
                <x-card label="total Upaid" :has_currency="true" icon="fi fi-rr-peso-sign" :total="$totalUnpaid" />
                </div>
            </div>


            <h1 class="text-lg font-bold text-primary">
               Monthly Collection of Monthly Amortilization
            </h1>

            <div x-data="lineChart" class="w-full min-h-32" x-init="updateData({{ json_encode($amortizationDataSet) }}, 'Monthly Amortization')">
                <div x-ref="chart">

                </div>
            </div>

            <x-table-body :columns="[
                'Month',
                'Amount',
                'Tenant',
                'Bldg No. & Room No.',
                'Type',
                'Status',
                'Due Date',
                'Created By',
                'Date & Time',
            ]" label="" :hideAction="true">

                @forelse ($amortizations as $amortization)
                    <tr>
                        <td>

                        </td>
                        <td>
                            {{ $amortization->created_at->format('F') }}
                        </td>
                        <td>

                        </td>
                        <td>
                            ₱ {{ number_format($amortization->amount) }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $amortization->tenant->user->profile->last_name }},
                            {{ $amortization->tenant->user->profile->first_name }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $amortization->tenant->room->room_number }}
                        </td>
                        <td>

                        </td>
                        <td class="capitalize">
                            {{ $amortization->type }}
                        </td>
                        <td>

                        </td>
                        <td class="capitalize">
                            {{ $amortization->status }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ date('F d, Y', strtotime($amortization->due_date)) }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $amortization->created_by }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $amortization->created_at->format('F d, Y h:s A') }}
                        </td>

                        {{-- <td class="flex gap-2 justify-center">
                            <a href="{{ route('super-admin.bills.show', ['bill' => $bill->id]) }}"
                                class="btn btn-accent btn-sm text-primary">
                                <i class="fi fi-rr-eye"></i>
                            </a> --}}
                        {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                                <i class="fi fi-rr-edit"></i>
                            </a> --}}
                        {{-- <form action="{{ route('admin.bills.destroy', ['bill' => $bill->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-error btn-sm">
                                    <i class="fi fi-rr-trash"></i>
                                </button>
                            </form> --}}
                        {{-- </td> --}}
                    </tr>
                @empty
                    <td>No Monthly Amortization</td>
                @endforelse


            </x-table-body>




            <h1 class="text-lg font-bold text-primary mt-24">
            Monthly Collection of Monthly Dues
            </h1>

            <div x-data="lineChart" class="w-full min-h-32" x-init="updateData({{ json_encode($monthlyDueDataSet) }}, 'Monthly Dues')">
                <div x-ref="chart">

                </div>
            </div>

            <x-table-body :columns="[
                'Month',
                'Amount',
                'Tenant',
                'Bldg No. & Unit No.',
                'Type',
                'Status',
                'Due Date',
                'Created By',
                'Date & Time',
            ]" label="" :hideAction="true">

                @forelse ($monthlyDues as $monthlyDue)
                    <tr>
                        <td>

                        </td>
                        <td>
                            {{ $monthlyDue->created_at->format('F') }}
                        </td>
                        <td>

                        </td>
                        <td>
                            ₱ {{ number_format($monthlyDue->amount) }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $monthlyDue->tenant->user->profile->last_name }},
                            {{ $monthlyDue->tenant->user->profile->first_name }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $monthlyDue->tenant->room->room_number }}
                        </td>
                        <td>

                        </td>
                        <td class="capitalize">
                            {{ $monthlyDue->type }}
                        </td>
                        <td>

                        </td>
                        <td class="capitalize">
                            {{ $monthlyDue->status }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ date('F d, Y', strtotime($monthlyDue->due_date)) }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $monthlyDue->created_by }}
                        </td>
                        <td>

                        </td>
                        <td>
                            {{ $monthlyDue->created_at->format('F d, Y h:s A') }}
                        </td>

                        {{-- <td class="flex gap-2 justify-center">
                            <a href="{{ route('super-admin.bills.show', ['bill' => $bill->id]) }}"
                                class="btn btn-accent btn-sm text-primary">
                                <i class="fi fi-rr-eye"></i>
                            </a> --}}
                        {{-- <a href="#" class="btn btn-secodary btn-sm text-primary">
                                <i class="fi fi-rr-edit"></i>
                            </a> --}}
                        {{-- <form action="{{ route('admin.bills.destroy', ['bill' => $bill->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-error btn-sm">
                                    <i class="fi fi-rr-trash"></i>
                                </button>
                            </form> --}}
                        {{-- </td> --}}
                    </tr>
                @empty
                    <td>No Monthly Dues</td>
                @endforelse


            </x-table-body>

        </div>



    </div>
</x-dashboard.super-admin.base>
