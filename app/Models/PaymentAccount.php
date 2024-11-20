<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'account_number',
        'qr_code',
        'tenement_id',
        'is_archived'
    ];



    public function tenement (){
        return $this->belongsTo(Tenement::class);
    }
    public function payments(){
        return $this->hasMany(BillPayment::class);
    }
}
