<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function tenant(){
        return $this->hasOne(Tenant::class);
    }
    public function announcementFeeds(){
        return $this->hasMany(AnnouncementFeed::class);
    }
    public function adminProfile(){
        return $this->hasOne(AdminProfile::class);
    }

    public function tenement(){
        return $this->hasOneThrough(Tenement::class, Room::class, 'id', 'id', 'tenant.room_id', 'tenement_id');
    }
    public function announcementViews(){
        return $this->hasMany(AnnouncementIsView::class);
    }
    public function payments(){
        return $this->hasMany(BillPayment::class);
    }
    public function conversation(){
        return $this->hasOne(Conversation::class);
    }
    public function sentMessages(){
        return $this->hasMany(ConversationMessage::class, 'sender_id');
    }
    public function receiveMessage(){
        return $this->hasMany(ConversationMessage::class, 'receiver_id');
    }
    public function announcements(){
        return $this->hasMany(Announcement::class);
    }
    public function familyMembers(){
        return $this->hasMany(FamilyMember::class);
    }
    public function participantConversations(){
        return $this->hasMany(Conversation::class, 'participant_id');
    }
}

