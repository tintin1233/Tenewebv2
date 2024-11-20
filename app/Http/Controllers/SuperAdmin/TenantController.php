<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use App\Enums\UserRoles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Tenement;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $searchTenement = $request->tenement;
        $tenements = Tenement::orderBy('name')->get();



        $tenement =  Tenement::orderBy('name')->first();

        $tenants = $tenement->tenants()->orderBy('last_name')->paginate(10);



        if($searchTenement){
            $tenement = Tenement::find($searchTenement);

            $tenants = $tenement->tenants()->orderBy('last_name')->paginate(10);
        }


        return view('user.super-admin.users.tenants.index', compact(['tenants', 'tenements', 'tenement']));
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
        //
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


        return back()->with([
            'message' => 'Tenant Deleted Success'
        ]);
    }
}
