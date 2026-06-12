<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'question',
        'expected_answer'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function answers()
    {
        return $this->hasMany(ClaimAnswer::class);
    }
}
