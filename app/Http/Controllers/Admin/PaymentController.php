<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bill;
use App\Models\BillPayment;
use App\Enums\GeneralStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index() {


        $authUser = Auth::user();
        $tenement = $authUser->adminProfile->tenement;


        $payments = BillPayment::where('status', GeneralStatus::PENDING->value)
        ->whereHas('bill.room', function($q) use($tenement){
            $q->where('tenement_id', $tenement->id);
        })->latest()->paginate(10);


        return view('user.admin.bill.payment.index', compact(['payments']));
    }

    public function show($id){
        $payment = BillPayment::find($id);



        return view('user.admin.bill.payment.show', compact(['payment']));
    }

    public function destroy($id){

        $payment = BillPayment::find($id);

        $payment->delete();

        return back()->with(['message' => 'payment deleted']);
    }

    public function verified($id) {
        $payment = BillPayment::find($id);


        $payment->bill->update([
            'status' => GeneralStatus::PAID->value
        ]);

        $payment->update([
            'status' => GeneralStatus::VERIFIED->value
        ]);


        return back()->with([
            'message' => 'Payment is Verified'
        ]);
    }

    public function reject($id){
        $payment = BillPayment::find($id);


        $payment->update([
            'status' => GeneralStatus::REJECT->value
        ]);


        return back()->with([
            'message' => 'payment is Rejected'
        ]);
    }
}
