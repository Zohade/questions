<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
