<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $tenement  = $user->adminProfile->tenement;

        $paymentAccounts = PaymentAccount::where('tenement_id', $tenement->id)->where('is_archived', false)->latest()->paginate(10);


        return view('user.admin.payment-accounts.index', compact(['paymentAccounts']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'account_number' => 'required'
        ]);

        $user = Auth::user();

        $tenement  = $user->adminProfile->tenement;



        $account = PaymentAccount::create([
            'name' => $request->name,
            'account_number' => $request->account_number,
            'tenement_id' => $tenement->id
        ]);



        if($request->hasFile('qr_code')){
            $imageName = 'DCMNT-' . uniqid() . '.' . $request->qr_code->extension();
            $dir = $request->qr_code->storeAs('/account/QR', $imageName, 'public');

            $account->update([
                'qr_code' => asset('/storage/' . $dir),
            ]);
        }

        return back()->with(['message' => 'Payment Account Added']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymentAccount = PaymentAccount::find($id);


        return view('user.admin.payment-accounts.show', compact(['paymentAccount']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paymentAccount = PaymentAccount::find($id);



        return view('user.admin.payment-accounts.edit', compact(['paymentAccount']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paymentAccount = PaymentAccount::find($id);


        $paymentAccount->update([
            'name' => $request->name,
            'account_number' => $request->account_number
        ]);



        if($request->hasFile('qr_code')){
            $imageName = 'DCMNT-' . uniqid() . '.' . $request->qr_code->extension();
            $dir = $request->qr_code->storeAs('/account/QR', $imageName, 'public');

            $paymentAccount->update([
                'qr_code' => asset('/storage/' . $dir),
            ]);
        }

        return back()->with(['message' => 'Payment Account Updated!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymentAccount = PaymentAccount::find($id);


        $paymentAccount->update(['is_archived' => true]);


        return back()->with(['message' => 'Payment Account Delete']);
    }

    public function restore(string $id)
    {
        $paymentAccount = PaymentAccount::find($id);

        $paymentAccount->update(['is_archived' => false]);

        return back()->with(['message' => 'Payment Account Restored']);
    }


    public function delete(string $id)
    {
        $paymentAccount = PaymentAccount::find($id);

        $paymentAccount->delete();

        return back()->with(['message' => 'Payment Account Deleted Success']);
    }
}
