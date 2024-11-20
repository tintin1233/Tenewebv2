<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;


    protected $fillable = [
        'room_number',
        'description',
        'rate',
        'status',
        'is_archived',
        'tenement_id',
        'building_id'
    ];


    public function tenement(){
        return $this->belongsTo(Tenement::class);
    }
    public function tenants(){
        return $this->hasMany(Tenant::class);
    }
    public function bills(){
        return $this->hasMany(Bill::class);
    }
    public function building(){
        return $this->belongsTo(Building::class);
    }
}
