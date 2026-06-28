<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
        'admin_id',
        'decision',
        'notes'
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
