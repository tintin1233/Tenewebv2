<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GeneralStatus;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->search;

        $authUser = Auth::user();
        $tenement = $authUser->adminProfile->tenement;

        $query = Room::where('tenement_id', $tenement->id)->where('is_archived', false);

        if ($search) {

            $query->where(function ($q) use ($search) {
                $q->where('status', $search)
                    ->orWhere('room_number', 'like' , '%' . $search . '%');
            });
        }


        $rooms = $query->paginate(10);

        $roomTotal = $query->count();

        $occupiedRoomTotal = $query->whereHas('tenants', function ($q) {
            $q->whereNull('move_out_date');
        })->count();


        $vacantRoomTotal = Room::where('tenement_id', $tenement->id)->where('is_archived', false)
            ->where('status', GeneralStatus::VACANT->value)->count();


        return view('user.admin.room.index', compact(['rooms', 'roomTotal', 'occupiedRoomTotal', 'vacantRoomTotal']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.admin.room.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required',
            'descriptions' => 'required',
        ]);


        $tenement = Auth::user()->adminProfile->tenement;


        Room::create([
            'room_number' => $request->room_number,
            'description' => $request->descriptions,
            'tenement_id' => $tenement->id
        ]);


        return back()->with(['message' => "Room Added Success"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $room = Room::find($id);

        return view('user.admin.room.show', compact(['room']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Room::find($id);


        return view('user.admin.room.edit', compact(['room']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Room::find($id);



        $room->update([
            'room_number' => $request->room_number,
            'description' => $request->descriptions,
            'rate' => $request->price,
        ]);



        return back()->with(['message' => "{$room->room_number} data Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


        $room = Room::find($id);


        $room->update(['is_archived' => true]);


        return back()->with(['message' => 'Room Deleted']);
    }

    public function archives(Request $request)
    {
        $authUser = Auth::user();
        $tenement = $authUser->adminProfile->tenement;

        if ($request->room) {

            $room = Room::find($request->room);

            if ($request->action === 'restore') {
                $room->update(['is_archived' => false]);
                return to_route('admin.rooms.archives')->with(['message' => 'data restored']);
            }

            if ($request->action === 'delete') {

                $room->delete();

                return to_route('admin.rooms.archives')->with(['message' => 'data permanently deleted']);
            }
        }

        $query = Room::where('tenement_id', $tenement->id)->where('is_archived', true);


        $rooms = $query->paginate(10);







        return view('user.admin.room.archived', compact(['rooms']));
    }
}
