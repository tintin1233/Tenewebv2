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
        Schema::create('pre_registers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('room_number')->nullable();
            $table->string('tenant_type');
            $table->string('last_name');
            $table->string('password');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('document');
            $table->string('image')->nullable();
            $table->string('gender');
            $table->foreignIdFor(Tenement::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_registers');
    }
};
