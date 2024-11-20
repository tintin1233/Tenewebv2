<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterList extends Model
{
    use HasFactory;


    protected $fillable = [
        'image',
        'last_name',
        'first_name',
        'middle_name',
        'age',
        'gender',
        'contact_no',
        'room_number',
        'tenement_id',
        'is_archived'
    ];


    public function tenement(){
        return $this->belongsTo(Tenement::class);
    }
}
