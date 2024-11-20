<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'birthdate',
        'relationship',
        'user_id'
    ];



    public function user(){
        return $this->belongsTo(User::class);
    }
}
