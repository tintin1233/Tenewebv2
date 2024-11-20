<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Bill;
use App\Enums\GeneralStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {


        $totalUnpaid = Bill::where('status', GeneralStatus::UNPAID->value)->sum('amount');

        $totalMonthlyDue = Bill::where('type', 'monthly dues')->where('status', GeneralStatus::PAID->value)->sum('amount');

        $totalAmortization = Bill::where('type', 'amortization')->where('status', GeneralStatus::PAID->value)->sum('amount');

        $totalRevenue =  Bill::where('status', GeneralStatus::PAID->value)->sum('amount');

        $amortizationDataSet = $this->amortizationDataChart();
        $amortizations = Bill::where('type', 'amortization')->get();
        $monthlyDueDataSet = $this->monthlyDueDataChart();
        $monthlyDues =  Bill::where('type', 'monthly dues')->get();



        return view(
            'user.super-admin.report.index',
            compact([
                'totalUnpaid',
                'totalMonthlyDue',
                'totalAmortization',
                'totalRevenue',
                'amortizationDataSet',
                'monthlyDueDataSet',
                'monthlyDues',
                'amortizations'
            ])
        );
    }

    private function amortizationDataChart()
    {
        $monthlyBills = array_fill_keys([
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
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
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
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
}
