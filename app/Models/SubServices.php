<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubServices extends Model
{
    use HasFactory;
    public function provider(){
     return $this->belongsToMany(Provider::class,'provider_subservices','subservice_id','provider_id')->withTimestamps();
    }
    
}
