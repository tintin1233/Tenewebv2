<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenement_id',
        'user_id',
        'participant_id'
    ];



    public function tenement(){
        return $this->belongsTo(Tenement::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function messages(){
        return $this->hasMany(ConversationMessage::class);
    }
    public function participant(){
        return $this->belongsTo(User::class);
    }
}
