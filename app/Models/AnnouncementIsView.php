<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementIsView extends Model
{
    use HasFactory;


    protected $fillable = [
        'announcement_id',
        'user_id'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function announcement (){
        return $this->belongsTo(Announcement::class);
    }
}
