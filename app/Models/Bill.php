<?php

namespace App\Models;

use App\Enums\GeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'amount',
        'status',
        'due_date',
        'room_id',
        'tenant_id',
        'created_by',
        'is_viewed'
    ];


    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }

    public function payments(){
        return $this->hasMany(BillPayment::class);
    }
}
