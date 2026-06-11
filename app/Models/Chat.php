<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'claim_id',
        'sender_id',
        'message'
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}