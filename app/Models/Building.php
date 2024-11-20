<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_units',
        'tenement_id'
    ];



    public function tenement(){
        return $this->belongsTo(Tenement::class);
    }
    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
