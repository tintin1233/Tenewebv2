<?php

use App\Enums\GeneralStatus;
use App\Models\Building;
use App\Models\Tenement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number');
            $table->longText('description');
            $table->string('rate')->nullable();
            $table->string('status')->default(GeneralStatus::VACANT->value);
            $table->boolean('is_archived')->default(false);
            $table->foreignIdFor(Tenement::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Building::class)->constrained('buildings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
