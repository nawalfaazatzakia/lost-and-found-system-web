<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
        'verification_question_id',
        'answer',
        'is_match'
    ];

    protected $casts = [
        'is_match' => 'boolean',
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function question()
    {
        return $this->belongsTo(VerificationQuestion::class, 'verification_question_id');
    }
}
