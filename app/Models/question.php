<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\option;

class question extends Model
{
    protected $fillable = [
        'libele',
        'reponse_unique',
    ];
   public function options(){
        return $this->hasMany(Option::class);
   }
}