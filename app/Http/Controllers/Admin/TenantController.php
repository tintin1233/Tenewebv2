<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GeneralStatus;
use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Models\PreRegister;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $authUser = Auth::user();
        $tenement =  $authUser->adminProfile->tenement;

        $search = $request->search;

        $tenants = User::role(UserRoles::TENANT->value)->where(function($q) use($tenement) {
            $q->whereHas('tenant', function($q) use($tenement) {
                $q->whereHas('room', function($q) use($tenement) {
                    $q->where('tenement_id', $tenement->id);
                })
                ->whereNull('move_out_date');
            });
        })
        ->whereHas('profile', function($q){
            $q->orderBy('last_name');
        })
        ->latest()->paginate(10);


        if($search){
            $tenants = User::role(UserRoles::TENANT->value)->where(function($q) use($tenement) {
                $q->whereHas('tenant', function($q) use($tenement) {
                    $q->whereHas('room', function($q) use($tenement) {
                        $q->where('tenement_id', $tenement->id);
                    })
                    ->whereNull('move_out_date');
                });
            })
            ->whereHas('profile', function($q) use($search){
                $q->where('last_name', 'like', '%' . $search . '%')
                ->orWhere('first_name', 'like' , '%' . $search . '%')
                ->orderBy('last_name');
            })->latest()->paginate(10);
        }


        $unverifiedTenantTotal = PreRegister::where('tenement_id', $tenement->id)->count();




        return view('user.admin.tenant.index', compact(['tenants', 'unverifiedTenantTotal']));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $tenant = User::find($id);

        return view('user.admin.tenant.show', compact(['tenant']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tenant = User::find($id);


        $tenant->delete();


        return back()->with(['message' => 'Tenant Deleted']);
    }


    public function moveOut(string $id){

        $tenant = Tenant::where('user_id', $id)->first();

       $tenant->update([
        'move_out_date' => now()
       ]);


       $room = $tenant->room;

       $room->update([
        'status' => GeneralStatus::VACANT->value
       ]);

       return back()->with([
            'message' => "Tenant is Move out in the {$room->room_number}"
       ]);
    }
}
