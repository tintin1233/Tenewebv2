<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'tenement_id',
        'is_archived',
        'user_id'
    ];



    public function tenement(){
        return $this->belongsTo(Tenement::class);
    }
    public function announcementFeeds(){
        return $this->hasMany(AnnouncementFeed::class);
    }
    public function userViews(){
        return $this->hasMany(AnnouncementIsView::class);
    }
    public function viewedByAuthUser (string $id){

        $user = Auth::user();

        return $this->whereHas('userViews', function($q) use($user, $id){
            $q->where('user_id', $user->id)
            ->where('announcement_id', $id);
        })->first();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
