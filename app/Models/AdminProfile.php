<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory;


    protected $fillable = [
        'tenement_id',
        'user_id'
    ];


    public function tenement(){
        return $this->belongsTo(Tenement::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
