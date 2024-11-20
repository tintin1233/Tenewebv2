<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Profile;
use App\Enums\UserRoles;
use App\Models\Tenement;
use App\Models\MasterList;
use App\Enums\GeneralStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MasterListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();

        $tenement = $user->adminProfile->tenement;

        $masterLists = MasterList::where('is_archived', false)
        ->where('tenement_id', $tenement->id)
        ->latest()
        ->paginate(10);

        return view('user.admin.master-list.index', compact(['masterLists']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $tenement = $user->adminProfile->tenement;



        $rooms = Room::where(function ($q) use($tenement ) {
            $q->where('tenement_id', $tenement->id)
            ->whereDoesntHave('tenants')
                ->orWhereHas('tenants', function ($q) {
                    $q->whereNull('move_out_date');
                });
        })->get();

        return view('user.admin.master-list.create', compact(['rooms']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|mimes:png,jpg',
            'last_name' => 'required',
            'first_name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'contact_no' => 'required',
            'room' => 'required'
        ]);

        $user = Auth::user();

        $tenement = $user->adminProfile->tenement;


        $imageName = 'PRFL-' . uniqid() . '.' . $request->image->extension();
        $dir = $request->image->storeAs('/master-list', $imageName, 'public');


        MasterList::create([
            'image' =>  asset('/storage/' . $dir),
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'age' => $request->age,
            'gender' => $request->gender,
            'contact_no' => $request->contact_no,
            'room_number' => $request->room,
            'tenement_id' => $tenement->id
        ]);


        return back()->with(['message' => 'Add Master List']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $masterList = MasterList::find($id);

        return view('user.admin.master-list.show', compact(['masterList']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $user = Auth::user();
        $tenement = $user->adminProfile->tenement;



        $rooms = Room::where(function ($q) use($tenement ) {
            $q->where('tenement_id', $tenement->id)
            ->whereDoesntHave('tenants')
                ->orWhereHas('tenants', function ($q) {
                    $q->whereNull('move_out_date');
                });
        })->get();

        $masterList = MasterList::find($id);


        return view('user.admin.master-list.edit', compact(['masterList', 'rooms']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $masterList = MasterList::find($id);


        $masterList->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'age' => $request->age,
            'gender' => $request->gender ?? $masterList->gender,
            'contact_no' => $request->contact_no,
            'room_number' => $request->room ?? $masterList->room_number,
        ]);


        if($request->hasFile('image')){
            $imageName = 'PRFL-' . uniqid() . '.' . $request->image->extension();
            $dir = $request->image->storeAs('/master-list', $imageName, 'public');


            $masterList->update([
                'image' =>  asset('/storage/' . $dir),
            ]);
        }



        return back()->with(['message' => 'Master List Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $masterList = MasterList::find($id);

        $masterList->update([
            'is_archived' => true
        ]);


        return back()->with(['message' => 'Data Deleted!']);
    }

    public function restore(string $id)
    {
        $masterList = MasterList::find($id);

        $masterList->update(['is_archived' => false]);

        return back()->with(['message' => 'Master List Restored']);
    }

    public function delete(string $id)
    {
        $masterList = MasterList::find($id);

        $masterList->delete();

        return back()->with(['message' => 'Master List Deleted Success']);
    }

    public function generateAccount(Request $request){


        $masterList = MasterList::find($request->master_list_id);

        $tenantRole = Role::where('name', UserRoles::TENANT->value)->first();

        $tenement = Tenement::find($masterList->tenement_id);

        $room = Room::where(function ($q) use ($masterList, $tenement) {
            $q->where('room_number', $masterList->room_number)
                ->where('tenement_id', $tenement->id);
        })->first();




        $user = User::create([
            'name' => "{$masterList->last_name}, {$masterList->first_Name}",
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);




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
}
