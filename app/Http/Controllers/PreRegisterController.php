<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Profile;
use App\Enums\UserRoles;
use App\Models\Tenement;
use App\Models\MasterList;
use App\Models\PreRegister;
use App\Enums\GeneralStatus;
use App\Models\AdminProfile;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PreRegisterNotification;

class PreRegisterController extends Controller
{
    public function create()
    {
        $tenements = Tenement::get();
        return view('pre-register.create', compact(['tenements']));
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'tenant_type' => 'required',
            'room_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'contact_no' => 'required',
            'document' => 'required',
            'tenement' => 'required',
            'password' => 'required'
        ]);


        $masterList =  MasterList::where('last_name', 'like', '%' . $request->last_name . '%')
        ->where('first_name', 'like', '%' . $request->first_name . '%')
        ->first();




        if($masterList){

            $tenement = Room::where('room_number', $masterList->room_number)->first()
            ->tenement;

            $tenantRole = Role::where('name', UserRoles::TENANT->value)->first();

            $user = User::create([
                'name' => "{$request->last_name}, {$request->first_Name}",
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);




            $room = Room::where(function ($q) use ($request, $tenement) {
                $q->where('room_number', $request->room_number)
                    ->where('tenement_id', $tenement->id);
            })->first();

            Profile::create([
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name ?? "N\A",
                'gender' => $request->gender,
                'contact_no' => $request->contact_no,
                'image' => $masterList->image,
                'user_id' => $user->id
            ]);

            Tenant::create([
                'move_in_date' => now(),
                'room_id' => $room->id,
                'user_id' => $user->id
            ]);


            $room->update([
                'status' => GeneralStatus::OCCUPIED->value
            ]);


            $user->assignRole($tenantRole);


            return back()->with(['message' => 'Account Created Success']);

        }



        $documentName = 'DCMNT-' . uniqid() . '.' . $request->document->extension();
        $docDir = $request->document->storeAs('/document', $documentName, 'public');

        $tenement = Tenement::find($request->tenement);

        $preRegister =  PreRegister::create([
            'name' => $request->name,
            'email' => $request->email,
            'tenant_type' => $request->tenant_type,
            'room_number' => $request->room_number,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'address' => $request->address,
            'contact_no' => $request->contact_no,
            'document' => asset('/storage/' . $docDir),
            'gender' => $request->gender,
            'password' => $request->password,
            'tenement_id' => $tenement->id
        ]);


        if ($request->hasFile('image')) {

            $imageName = 'DCMNT-' . uniqid() . '.' . $request->image->extension();
            $dir = $request->image->storeAs('/profile', $imageName, 'public');

            $preRegister->update([
                'image' => asset('/storage/' . $dir),
            ]);
        }


        // $admin = $tenement->adminProfile->user ?? null;

        // if(!$admin){
        //     $admin = User::role(UserRoles::SUPERADMIN->value)->first();
        // }

        // $message = [
        //     'message' => "New Pre Register Tenant in Tenement: {$tenement->name}, Room : {$request->room_number}"
        // ];

        // $admin->notify(new PreRegisterNotification($message));


        return back()->with(['message' => 'Pre Register Sent Admin Will Sent Email for the Verification']);
    }
    public function getRooms(string $id)
    {


        $rooms = Room::where(function ($q) use ($id) {
            $q->where('tenement_id', $id)
            ->where('status', GeneralStatus::VACANT->value);
        })->get();

        return response([
            'rooms' => $rooms
        ], 200);
    }
}
