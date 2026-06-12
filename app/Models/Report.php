<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_name',
        'type',
        'category',
        'description',
        'location',
        'date',
        'image',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function verificationQuestions()
    {
        return $this->hasMany(VerificationQuestion::class);
    }
}