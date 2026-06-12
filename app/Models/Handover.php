<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Handover extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
        'confirmed_by_reporter',
        'confirmed_by_claimer',
        'status',
        'completed_at'
    ];

    protected $casts = [
        'confirmed_by_reporter' => 'boolean',
        'confirmed_by_claimer' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }
}
