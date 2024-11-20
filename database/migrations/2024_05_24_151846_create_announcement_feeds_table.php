<?php

use App\Models\Announcement;
use App\Models\AnnouncementFeed;
use App\Models\User;
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
        Schema::create('announcement_feeds', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->foreignIdFor(Announcement::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(AnnouncementFeed::class, 'reply_id')->nullable()->constrained('announcement_feeds')->onDelete('cascade');
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcement_feeds');
    }
};
