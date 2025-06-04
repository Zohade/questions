<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\question;

class option extends Model
{
    protected $fillable = [
        'libele',
        'is_true',
        'question_id',
    ];
    public function question(){
        return $this->belongsTo(Question::class);
    }
}