<?php

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
        Schema::create('master_lists', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('age');
            $table->string('gender')->default('N\A');
            $table->string('contact_no');
            $table->string('room_number');
            $table->boolean('is_archived')->default(false);
            $table->foreignIdFor(Tenement::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_lists');
    }
};
