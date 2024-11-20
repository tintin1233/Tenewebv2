<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Tenement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $tenements = Tenement::all();

        foreach ($tenements as $tenement) {
            for ($i = 1; $i <= 100; $i++) {
                Room::create([
                    'room_number' => "Room $i",
                    'description' => 'This is a dummy description for Room ' . $i,
                    'rate' => '100.00', // you can set any default rate or randomize it
                    'status' => \App\Enums\GeneralStatus::VACANT->value, // adjust the namespace accordingly
                    'tenement_id' => $tenement->id,
                ]);
            }
        }
    }
}
