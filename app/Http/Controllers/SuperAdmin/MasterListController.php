<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enums\GeneralStatus;
use App\Models\MasterList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenement;

class MasterListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->search;

        $searchTenement = $request->tenement;

        $tenement = Tenement::orderBy('name')->first();
        if ($searchTenement) {

            $tenement = Tenement::find($searchTenement);
        }

        $tenements = Tenement::orderBy('name')->get();




        $masterLists = $tenement->masterLists()->where('is_archived', false)
            ->orderBy('last_name')
            ->latest()
            ->paginate(10);

        if ($search) {
            $masterLists = MasterList::where(function ($q) use ($search) {
                $q->where('last_name', 'like', '%' . $search . '%')
                    ->orWhere('first_name', 'like' . '%' . $search . '%')
                    ->orWhere('room_number', 'like', '%' . $search . '%')
                    ->orWhereHas('tenement', function ($q) use ($search) {
                        $q->where('name', $search);
                    });
            })->orderBy('last_name')->latest()->paginate(10);
        }


        return view('user.super-admin.master-list.index', compact(['masterLists', 'tenements', 'tenement']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $tenements = Tenement::with([
            'buildings' => function ($q) {
                $q->with([
                    'rooms' => function ($q) {
                        $q->where('status', '!=', GeneralStatus::OCCUPIED->value);
                    }
                ]);
            }
        ])->get();


        return view('user.super-admin.master-list.create', compact(['tenements']));
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
            // 'age' => 'required',
            // 'gender' => 'required',
            // 'contact_no' => 'required',
            'room' => 'required',
            'tenement' => 'required'
        ]);


        $imageName = 'PRFL-' . uniqid() . '.' . $request->image->extension();
        $dir = $request->image->storeAs('/master-list', $imageName, 'public');


        MasterList::create([
            'image' =>  asset('/storage/' . $dir),
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'age' => 'N\A',
            'contact_no' => 'N\A',
            'room_number' => $request->room,
            'tenement_id' => $request->tenement
        ]);


        return back()->with(['message' => 'Add Master List']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $masterList = MasterList::find($id);

        return view('user.super-admin.master-list.show', compact(['masterList']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tenements = Tenement::with([
            'rooms' => function ($q) {
                $q->where('status', '!=', GeneralStatus::OCCUPIED->value);
            }
        ])->get();

        $masterList = MasterList::find($id);


        return view('user.super-admin.master-list.edit', compact(['masterList', 'tenements']));
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


        if ($request->hasFile('image')) {
            $imageName = 'PRFL-' . uniqid() . '.' . $request->image->extension();
            $dir = $request->image->storeAs('/master-list', $imageName, 'public');


            $masterList->update([
                'image' =>  asset('/storage/' . $dir),
            ]);
        }
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
}
