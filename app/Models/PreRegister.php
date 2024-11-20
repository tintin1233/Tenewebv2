<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreRegister extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'email',
        'tenant_type',
        'room_number',
        'last_name',
        'first_name',
        'middle_name',
        'address',
        'contact_no',
        'document',
        'image',
        'gender',
        'password',
        'tenement_id'
    ];

    public function tenement(){
        return $this->belongsTo(Tenement::class);
    }
}
