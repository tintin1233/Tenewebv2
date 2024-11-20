<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;


    protected $fillable = [
        'image',
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'gender',
        'contact_no',
        'user_id'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
