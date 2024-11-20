<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenement extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'image',
        'number_of_units',
        'number_of_buildings'
    ];


    public function rooms(){
        return $this->hasMany(Room::class);
    }
    public function announcements(){
        return $this->hasMany(Announcement::class);
    }
    public function tenants(){
        return $this->hasManyThrough(Tenant::class, Room::class);
    }
    public function activeTenants(){
        return $this->tenants()->whereNull('move_out_date')->get();
    }
    public function adminProfile(){
        return $this->hasOne(AdminProfile::class);
    }
    public function tenantPreRegister(){
        return $this->hasMany(PreRegister::class);
    }
    public function paymentAccounts(){
        return $this->hasMany(PaymentAccount::class);
    }
    public function masterLists(){
        return $this->hasMany(MasterList::class);
    }
    public function conversations(){
        return $this->hasMany(Conversation::class);
    }

    public function buildings (){
        return $this->hasMany(Building::class);
    }
}
