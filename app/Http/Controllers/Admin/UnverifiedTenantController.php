<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Profile;
use App\Enums\UserRoles;
use App\Models\PreRegister;
use App\Enums\GeneralStatus;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Notifications\TenantNotification;
use Illuminate\Support\Facades\Notification;

class UnverifiedTenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUser = Auth::user();
        $tenement =  $authUser->adminProfile->tenement;

        $tenants = User::role(UserRoles::TENANT->value)->where(function($q) use($tenement) {
            $q->whereHas('tenant', function($q) use($tenement) {
                $q->whereHas('room', function($q) use($tenement) {
                    $q->where('tenement_id', $tenement->id);
                });
            });
        })->count();

        $unverifiedTenants = PreRegister::where('tenement_id', $tenement->id)->latest()->paginate(10);

        return view('user.admin.tenant.unverified-tenant.index', compact(['tenants', 'unverifiedTenants']));
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

        $unverifiedTenant = PreRegister::find($request->unverifiedTenantId);


        $tenantRole = Role::where('name', UserRoles::TENANT->value)->first();

        $user = User::create([
            'name' => "{$unverifiedTenant->last_name}, {$unverifiedTenant->first_Name}",
            'email' => $unverifiedTenant->email,
            'password' => Hash::make($unverifiedTenant->password)
        ]);


        $tenement = $unverifiedTenant->tenement;


        $room = Room::where(function ($q) use ($unverifiedTenant, $tenement) {
            $q->where('room_number', $unverifiedTenant->room_number)
                ->where('tenement_id', $tenement->id);
        })->first();

        Profile::create([
            'last_name' => $unverifiedTenant->last_name,
            'first_name' => $unverifiedTenant->first_name,
            'middle_name' => $unverifiedTenant->middle_name ?? "N\A",
            'gender' => $unverifiedTenant->gender,
            'contact_no' => $unverifiedTenant->contact_no,
            'image' => $unverifiedTenant->image,
            'user_id' => $user->id
        ]);

        Tenant::create([
            'move_in_date' => now(),
            'room_id' => $room->id,
            'user_id' => $user->id
        ]);

        $unverifiedTenant->delete();

        $room->update([
            'status' => GeneralStatus::OCCUPIED->value
        ]);


        $user->assignRole($tenantRole);


        $message = [
            'url' => route('login'),
            'message' => "Your Pre Register is Accepted"
        ];


        $user->notify(new TenantNotification($message));


        return to_route('admin.tenants.index')->with(['message' => 'Tenant Added']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unverifiedTenant = PreRegister::find($id);


        return view('user.admin.tenant.unverified-tenant.show', compact(['unverifiedTenant']));
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
        $unverifiedTenant = PreRegister::find($id);

        $notification = new class ($unverifiedTenant->email) {

            use Notifiable;

            public $email;

            public function __construct($email)
            {
                $this->email = $email;
            }

            public function routeNotificationForMail()
            {
                return $this->email;
            }
        };

        $user = Auth::user();

        $message = [
            'url' => null,
            'message' => "Pre Register is Rejected by Admin: {$user->name}"
        ];

        Notification::send($notification, new TenantNotification($message));


        $unverifiedTenant->delete();



        return to_route('admin.unverified-tenant.index')->with(['message' => 'Pre Register Tenant Delete/Rejected']);
    }
}
