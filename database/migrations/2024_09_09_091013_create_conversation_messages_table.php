<?php

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conversation_messages', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->foreignIdFor(User::class, 'sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignIdFor(User::class, 'receiver_id')->constrained('users')->onDelete('cascade');
            $table->foreignIdFor(Conversation::class)->constrained()->onDelete('cascade');
            $table->boolean('is_seen')->default(false);
            $table->string('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_messages');
    }
};
