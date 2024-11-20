<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_no',
        'bill_id',
        'payment_account_id',
        'amount',
        'user_id',
        'receipt',
        'status'
    ];



    public function bill(){
        return $this->belongsTo(Bill::class);
    }
    public function paymentAccount(){
        return $this->belongsTo(PaymentAccount::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
