<?php

namespace App\Http\Controllers\Tenant;

use App\Enums\GeneralStatus;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Models\PaymentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillPaymentController extends Controller
{
    public function pay(Request $request, string $id){
        $paymentAccount = PaymentAccount::find($id);
        $bill_id = $request->bill;


        $bill = Bill::find($bill_id);


        return view('user.tenant.bill.payment.show', compact(['paymentAccount', 'bill']));
    }

    public function store(Request $request){
        $request->validate([
            'refferrence_number' => 'required',
            'amount' => 'required',
            'receipt' => 'required|mimes:png,jpg'
        ]);

        $bill = Bill::find($request->bill_id);

        $hasPendingBill = $bill
        ->payments()
        ->where('status', GeneralStatus::PENDING->value)->first();


        if($hasPendingBill){
            return back()->with(['error' => 'You have a pending payment Request']);
        }


            $imageName = 'RCPT-' . uniqid() . '.' . $request->receipt->extension();
            $dir = $request->receipt->storeAs('/payment/receipt/', $imageName, 'public');





        BillPayment::create([
            'ref_no' => $request->refferrence_number,
            'bill_id' => $bill->id,
            'payment_account_id' => $request->payment_account_id,
            'amount' => $request->amount,
            'user_id' => Auth::user()->id,
            'receipt' => asset('/storage/' . $dir),
        ]);


        return to_route('tenant.bills.show', ['bill' => $bill->id])->with(['message' => 'Payment Success!']);
    }
}
