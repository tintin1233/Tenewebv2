<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enums\UserRoles;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminProfile;
use App\Models\Tenement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admins = User::role('admin')->paginate(10);
        $tenementParam = $request->tenement;
        $tenements = Tenement::get();

        if($tenementParam){
            $admins = User::role('admin')->where(function($q) use($tenementParam){
                $q->whereHas('adminProfile', function($q) use($tenementParam) {
                    $q->where('tenement_id', $tenementParam);
                });
            })->paginate(10);
        }

        return view('user.super-admin.users.admins.index', compact(['admins', 'tenements']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tenements = Tenement::get();


        return view('user.super-admin.users.admins.create', compact(['tenements']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'tenement' => 'required',
            'admin_password' => 'required'
        ]);


        $user = Auth::user();


        if(!Hash::check($request->admin_password, $user->password)){
            return back()->with([
                'error' => 'Super Admin Password is Incorrect'
            ]);
        }



        $adminRole = Role::where('name', UserRoles::ADMIN->value)->first();


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        $tenement = Tenement::find($request->tenement);

        $adminProfile = AdminProfile::create([
            'user_id' => $user->id,
            'tenement_id' => $tenement->id
        ]);




        $user->assignRole($adminRole);



        return back()->with(['message' => "Admin Added Success in {$tenement->name}"]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('user.super-admin.users.admins.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $admin = User::find($id);


        $tenements = Tenement::get();

        return view('user.super-admin.users.admins.edit', compact(['admin', 'tenements']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = User::find($id);



        if($request->password){

            $request->validate(([
                'password' => 'confirmed'
            ]));



            $admin->update([
                'password' => Hash::make($request->password)
            ]);
        }


        $admin->update([
            'name' => $request->name ?? $admin->name,
            'email' => $request->email ?? $admin->email
        ]);


        return back()->with(['message' => 'Admin Data Updated Success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::find($id);

        $admin->delete();

        return back()->with(['message' => 'Admin Data Deleted Success']);
    }
}
