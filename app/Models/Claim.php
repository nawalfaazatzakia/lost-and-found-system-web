<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'user_id',
        'proof',
        'status'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function answers()
    {
        return $this->hasMany(ClaimAnswer::class);
    }

    public function handover()
    {
        return $this->hasOne(Handover::class);
    }

    public function adminReviews()
    {
        return $this->hasMany(AdminReview::class);
    }
}