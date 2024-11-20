<?php

namespace App\Http\Controllers\Tenant;

use App\Enums\GeneralStatus;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $authUser = Auth::user();

        $tenement = $authUser->tenant->room->tenement;
        $room = $authUser->tenant->room;


        $totalAmortizationBill = Bill::where('room_id', $room->id)
            ->where('type', 'amortization')->where('status', GeneralStatus::UNPAID->value)->sum('amount');

        $totalAnnouncement = Announcement::where('is_archived', false)->where('tenement_id', $tenement->id)->count();
        $totalMonthlyDuesBill = Bill::where('room_id', $room->id)
            ->where('type', 'monthly dues')->where('status', GeneralStatus::UNPAID->value)->sum('amount');
        $totalMonthlyDues = Bill::where('type', 'monthly dues')->where('status', GeneralStatus::PAID->value)->sum('amount');
        $totalAmortization = Bill::where('type', 'amortization')
            ->where('status', GeneralStatus::PAID->value)->sum('amount');


        $announcement = Announcement::where('is_archived', false)->where('tenement_id', $tenement->id)->latest()->first();



        return view('user.tenant.dashboard', compact([
            'tenement',
            'room',
            'totalAmortizationBill',
            'announcement',
            'totalAnnouncement',
            'totalMonthlyDuesBill',
            'totalMonthlyDues',
            'totalAmortization'
        ]));
    }
}
