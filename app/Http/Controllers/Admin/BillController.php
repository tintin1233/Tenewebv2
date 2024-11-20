<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GeneralStatus;
use App\Models\Bill;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BillPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $authUser = Auth::user();
        $tenement = $authUser->adminProfile->tenement;


        $totalPayments = BillPayment::where(function ($q) use ($tenement) {
            $q->whereHas('bill', function ($q) use ($tenement) {
                $q->whereHas('room', function($q) use($tenement){
                    $q->where('tenement_id', $tenement->id);
                });
            })
                ->where('status', GeneralStatus::PENDING->value);
        })->count();


        $query = Bill::where(function ($q) use ($tenement) {
            $q->whereHas('room', function ($q) use ($tenement) {
                $q->where('tenement_id', $tenement->id);
            });
        });


        $bills = $query->where('status', GeneralStatus::PAID->value)->latest()->paginate(10);

        $unpaidBills = Bill::where(function ($q) use ($tenement) {
            $q->whereHas('room', function ($q) use ($tenement) {
                $q->where('tenement_id', $tenement->id);
            });
        })->where('status', GeneralStatus::UNPAID->value)->latest()->paginate(10);




        return view('user.admin.bill.index', compact(['bills', 'totalPayments', 'unpaidBills']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $tenant = User::find($request->tenant);

        return view('user.admin.tenant.bill.create', compact(['tenant']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required',
            'amount' => 'required',
            'type' => 'required'
        ]);

        $tenant = Tenant::find($request->tenant);

        Bill::create([
            'due_date' => $request->due_date,
            'type' => $request->type,
            'tenant_id' => $tenant->id,
            'room_id' => $tenant->room->id,
            'created_by' => Auth::user()->name
        ]);



        return back()->with(['message' => "Bill {$request->type} added"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bill = Bill::find($id);


        return view('user.admin.bill.show', compact(['bill']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bill = Bill::find($id);


        return view('user.admin.bill.edit', compact(['bill']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bill = Bill::find($id);



        $bill->update([
            'name' => $request->name ?? $bill->name,
            'amount' => $request->amount ?? $bill->amount,
            'type' => $request->type ?? $bill->type
        ]);


        return back()->with(['message' => "Bill {$bill->name} Data Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bill = Bill::find($id);

        $bill->delete();


        return back()->with(['message' => 'Bill Deleted Success']);
    }


    public function createAll(Request $request)
    {


        if($request->send_type === 'specific') {


            $user = User::find($request->user_id);

            $month = Carbon::parse($request->month)->startOfMonth();
            if ($month->isPast()) {
                $month->addYear();
            }

            Bill::create([
                'due_date' => $request->due_date,
                'type' => $request->type,
                'amount' => $request->amount,
                'due_date' => $month,
                'tenant_id' => $user->tenant->id,
                'room_id' => $user->tenant->room->id,
                'created_by' => Auth::user()->name
            ]);


            return back()->with(['message' => "Bill Sent to {$user->profile->last_name}, {$user->profile->first_name}"]);
        }


        $request->validate([
            // 'name' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'due_date' => 'required'
        ]);


        $authUser = Auth::user();
        $tenement = $authUser->adminProfile->tenement;


        $tenants = Tenant::where(function ($q) use ($tenement) {
            $q->whereNull('move_out_date')
                ->whereHas('room', function ($q) use ($tenement) {
                    $q->where('tenement_id', $tenement->id);
                });
        })->get();


        if (count($tenants) === 0) {
            return back()->with(['error' => "Request can't process there's no Tenant"]);
        }


        collect($tenants)->map(function ($tenant) use ($request) {
            Bill::create([
                'amount' => $request->amount,
                'due_date' => $request->due_date,
                'type' => $request->type,
                'tenant_id' => $tenant->id,
                'room_id' => $tenant->room->id,
                'created_by' => Auth::user()->name
            ]);
        });



        return back()->with(['message' => 'Bills Sent!']);
    }
}
