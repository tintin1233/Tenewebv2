<?php

namespace App\Models;

use App\Enums\GeneralStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'move_in_date',
        'move_out_date',
        'room_id',
        'user_id'
    ];



    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public static function totalActive(string $tenementId)
    {
        return self::whereNull('move_out_date')
            ->whereHas('room', function ($q) use ($tenementId) {
                $q->where('tenement_id', $tenementId);
            })->count();
    }

    public function totalUnpaidBills(){
        return $this->bills()->where('status', GeneralStatus::UNPAID->value)->sum('amount');
    }
}
