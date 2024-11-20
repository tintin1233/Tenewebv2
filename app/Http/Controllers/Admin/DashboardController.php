<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GeneralStatus;
use App\Models\Bill;
use App\Models\User;
use App\Models\Tenant;
use App\Models\PreRegister;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function dashboard()
    {

        $authUser = Auth::user();
        $tenement = $authUser->adminProfile->tenement;

        $unverifiedTenants = PreRegister::where('tenement_id', $tenement->id)->paginate(10);

        $totalAnnouncements = Announcement::where('tenement_id', $tenement->id)->count();

        $totalCollections = Bill::where('status', GeneralStatus::PAID->value)
        ->whereHas('room', function($q) use ($tenement){
            $q->where('tenement_id', $tenement->id);
        })->sum('amount');



        $billAmortization = $this->billsDataSet($tenement->id, 'monthly amortization');
        $billMonthlyDue = $this->billsDataSet($tenement->id, 'monthly dues');


        $totalTenant = Tenant::totalActive($tenement->id);

        return view('user.admin.dashboard', compact([

            'unverifiedTenants',
            'totalTenant',
            'totalAnnouncements',
            'totalCollections',
            'billAmortization',
            'billMonthlyDue'
        ]));
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
