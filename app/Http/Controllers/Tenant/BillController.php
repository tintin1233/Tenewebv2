<?php

namespace App\Http\Controllers\Tenant;

use App\Enums\GeneralStatus;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\PaymentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index(){

        $authUser = Auth::user();


        $bills = $authUser->tenant->bills()->latest()->paginate(10);


        return view('user.tenant.bill.index', compact(['bills']));
    }

    public function show(string $id){

        $bill = Bill::find($id);
        $authUser = Auth::user();

        $tenement = $authUser->tenant->room->tenement;

        $paymentAccounts = PaymentAccount::where('tenement_id', $tenement->id)->where('is_archived', false)->get();


        if(!$bill->is_viewed){

            $bill->update([
                'is_viewed' => true
            ]);
        }

        return view('user.tenant.bill.show', compact(['bill', 'paymentAccounts']));
    }
}
