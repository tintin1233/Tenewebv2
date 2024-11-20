<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Bill;
use App\Models\Room;
use App\Models\Building;
use App\Enums\GeneralStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BuildingController extends Controller
{
    public function show(string $id, Request $request)
    {
        $building = Building::find($id);


        $rooms = $building->rooms()->paginate(10);


        $search = $request->search;

        if ($search) {
            $rooms = Room::where('building_id', $building->id)
                ->where('room_number', 'like', '%' . $search . '%')->paginate(10);
        }

        $billAmortization = $this->billsBuildingDataSet($building->id, 'monthly amortization');

        $billMonthlyDue = $this->billsBuildingDataSet($building->id, 'monthly dues');

        return view('user.super-admin.tenement.building.show', compact(['building', 'rooms', 'billAmortization', 'billMonthlyDue']));
    }


    public function room(string $id)
    {

        $room = Room::find($id);

        $totalMonthlyDue = $room->bills()->where('status', GeneralStatus::PAID->value)
        ->where('type', 'monthly dues')->sum('amount');


        $totalAmortization = $room->bills()->where('status', GeneralStatus::PAID->value)
        ->where('type', 'monthly amortization')->sum('amount');

        $totalMonthlyDueUnpaid = $room->bills()->where('status', GeneralStatus::UNPAID->value)
        ->where('type', 'monthly dues')->sum('amount');


        $totalAmortizationUnpaid = $room->bills()->where('status', GeneralStatus::UNPAID->value)
        ->where('type', 'monthly amortization')->sum('amount');

        $pieDataSet = $this->billsDataSet();

       $monthlyDataSet = $this->monthlyReportDataSet();

        return view('user.super-admin.tenement.room.show', compact([
            'room', 'totalMonthlyDue',  'totalAmortization' , 'pieDataSet', 'monthlyDataSet', 'totalMonthlyDueUnpaid', 'totalAmortizationUnpaid'
        ]));
    }


    private function billsDataSet()
    {
        return [
            [
                'name' => 'Unpaid Bills',
                'total' => Bill::where('status', GeneralStatus::UNPAID->value)->sum('amount'),
            ],
            [
                'name' => 'Paid Bills',
                'total' => Bill::where('status', GeneralStatus::PAID->value)->sum('amount'),
            ]
        ];
    }

    private function monthlyReportDataSet()
    {
        $billSums = Bill::whereIn('type', ['monthly dues', 'monthly amortization'])
            ->select(
                DB::raw("strftime('%m', due_date) as month"),
                DB::raw("SUM(amount) as total")
            )
            ->groupBy(DB::raw("strftime('%m', due_date)"))
            ->orderBy(DB::raw("strftime('%m', due_date)"))
            ->get()
            ->map(function ($item) {
                // Convert month number to month name
                $item->month = Carbon::createFromFormat('m', $item->month)->format('F');
                return $item;
            })
            ->keyBy('month')
            ->toArray();

        // Step 2: Create an array of all months with default total of 0
        $allMonths = collect([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ]);

        // Step 3: Merge results to ensure all months are present
        $result = $allMonths->map(function ($month) use ($billSums) {
            return [
                'month' => $month,
                'total' => $billSums[$month]['total'] ?? 0
            ];
        });

        // Convert to array if needed
        $resultArray = $result->toArray();

        // Output result
        return $resultArray;
    }
    private function billsBuildingDataSet(string $buildingId, string $type)
    {
        return [
            [
                'name' => 'Unpaid Bills',
                'total' => Bill::where('status', GeneralStatus::UNPAID->value)
                ->whereHas('room', function($q) use($buildingId){
                    $q->where('building_id', $buildingId);
                })->where('type', $type)->sum('amount'),
            ],
            [
                'name' => 'Paid Bills',
                'total' => Bill::where('status', GeneralStatus::PAID->value)
                ->whereHas('room', function($q) use($buildingId){
                    $q->where('building_id', $buildingId);
                })->where('type', $type)->sum('amount'),
            ]
        ];
    }
}
