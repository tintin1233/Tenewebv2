<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Bill;
use App\Models\Room;
use App\Models\Building;
use App\Models\Tenement;
use App\Enums\GeneralStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $tenements = Tenement::orderBy('name')->latest()->get();

        $tenement = Tenement::orderBy('name')->latest()->first();

        $totalSales = Bill::where('status', GeneralStatus::PAID->value)->sum('amount');
        $totalBuilding = Building::count();
        $totalUnits = Room::count();

        $searchTenement = $request->tenement;

        if($searchTenement){

            $tenement = Tenement::find($searchTenement);
        }


        return view('user.super-admin.tenement.index', compact(['tenement', 'tenements', 'totalSales', 'totalBuilding', 'totalUnits']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.super-admin.tenement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'number_of_units',
            'number_of_buildings'
        ]);



        $imageName = 'TNMNTS-' . uniqid() . '.' . $request->image->extension();
        $dir = $request->image->storeAs('/tenements', $imageName, 'public');


        $tenement = Tenement::create([
            'name' => $request->name,
            'image' => asset('/storage/' . $dir),
            'description' => $request->description,
            'number_of_buildings' => $request->number_of_buildings,
            'number_of_units' => $request->number_of_units
        ]);



        $this->generateBuildings($request->number_of_units, $request->number_of_buildings, $tenement);




        return back()->with([
            'message' => 'Tenement Added'
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tenement = Tenement::find($id);


        return view('user.super-admin.tenement.show', compact(['tenement']));
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
        //
    }

    private static function generateBuildings(string $numberOfUnits, string $numberOfBuildings, Tenement $tenement) {


        for($i = 1; $i <= $numberOfBuildings; $i++) {

            $building = Building::create([
                'name' => "Building {$i}",
                'tenement_id' => $tenement->id,
                'total_units' => $numberOfUnits
            ]);

            $initialUnits = 1;

            $rooms = [];

            for ($initialUnits = 1; $initialUnits <= $numberOfUnits; $initialUnits++) {
                $rooms[] = [
                    'room_number' => "B-{$i} Unit {$initialUnits}",
                    'description' => "N\A",
                    'tenement_id' => $tenement->id,
                    'building_id' => $building->id,
                    'created_at' => now(), // Include timestamps if necessary
                    'updated_at' => now()
                ];
            }
            Room::insert($rooms);

            $initialUnits = 1;

        }
    }
}
