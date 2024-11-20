<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Bill;
use App\Models\Tenant;
use App\Models\Tenement;
use App\Enums\GeneralStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {


        $tenantTotal = Tenant::whereNull('move_out_date')->count();

        $searchTenement = $request->tenement;

        $tenementTotal = Tenement::count();

        $monthlyDataSet = $this->monthlyReportDataSet();

        $totalSales = Bill::where('status', GeneralStatus::PAID->value)->sum('amount');

        $amortizationDataSet = $this->amortizationDataChart();
        $monthlyDueDataSet = $this->monthlyDueDataChart();
        $tenements = Tenement::orderBy('name')->get();
        $tenement = Tenement::orderBy('name')->first();


        if($searchTenement){
            $tenement = Tenement::find($searchTenement);
        }

        $billAmortization = $this->billsDataSet($tenement->id ?? 0, 'monthly amortization');
        $billMonthlyDue = $this->billsDataSet($tenement->id ?? 0, 'monthly dues');
        return view('user.super-admin.dashboard', compact([
            'tenantTotal',
            'tenementTotal',
            'totalSales',
            'amortizationDataSet',
            'monthlyDueDataSet',
            'billAmortization',
            'billMonthlyDue',
            'tenements',
            'tenement'
        ]));
    }
    public function monthlyReportDataSet()
    {
        $billSums = Bill::whereIn('type', ['monthly dues', 'monthly amortization'])
            ->select(
                DB::raw("strftime('%m', due_date) as month"),
                DB::raw("SUM(amount) as total")
            )
            ->groupBy(DB::raw("strftime('%m', due_date)"))
            ->orderBy(DB::raw("strftime('%m', due_date)"))
            ->get()
            ->map(function ($item) {
                // Convert month number to month name
                $item->month = Carbon::createFromFormat('m', $item->month)->format('F');
                return $item;
            })
            ->keyBy('month')
            ->toArray();

        // Step 2: Create an array of all months with default total of 0
        $allMonths = collect([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ]);

        // Step 3: Merge results to ensure all months are present
        $result = $allMonths->map(function ($month) use ($billSums) {
            return [
                'month' => $month,
                'total' => $billSums[$month]['total'] ?? 0
            ];
        });

        // Convert to array if needed
        $resultArray = $result->toArray();

        // Output result
        return $resultArray;
    }

    private function amortizationDataChart()
    {
        $monthlyBills = array_fill_keys([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ], 0);


        $bills = Bill::where('type', 'amortization')
            ->whereYear('due_date', Carbon::now()->year)
            ->get()
            ->groupBy(function ($bill) {
                return Carbon::parse($bill->due_date)->format('F');
            });


        foreach ($bills as $month => $monthBills) {
            $monthlyBills[$month] = $monthBills->sum('amount');
        }

        return $monthlyBills;
    }
    private function monthlyDueDataChart()
    {
        $monthlyBills = array_fill_keys([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ], 0);


        $bills = Bill::where('type', 'monthly dues')
            ->whereYear('due_date', Carbon::now()->year)
            ->get()
            ->groupBy(function ($bill) {
                return Carbon::parse($bill->due_date)->format('F');
            });


        foreach ($bills as $month => $monthBills) {
            $monthlyBills[$month] = $monthBills->sum('amount');
        }

        return $monthlyBills;
    }

    private function billsDataSet(string $tenementId, string $type)
    {
        return [
            [
                'name' => 'Unpaid Bills',
                'total' => Bill::where('status', GeneralStatus::UNPAID->value)
                    ->whereHas('room', function ($q) use ($tenementId) {
                        $q->where('tenement_id', $tenementId);
                    })->where('type', $type)->sum('amount'),
            ],
            [
                'name' => 'Paid Bills',
                'total' => Bill::where('status', GeneralStatus::PAID->value)
                    ->whereHas('room', function ($q) use ($tenementId) {
                        $q->where('tenement_id', $tenementId);
                    })->where('type', $type)->sum('amount'),
            ]
        ];
    }
}
