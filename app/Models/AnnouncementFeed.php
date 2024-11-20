<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementFeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'announcement_id',
        'is_approved',
        'is_archived',
        'reply_id',
        'user_id'
    ];


    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(AnnouncementFeed::class, 'reply_id');
    }
    public function comment(){
        return $this->belongsTo(AnnouncementFeed::class);
    }
}
