<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable=[

        'name',
        'password',
        'phone_number',
        'city_id'
    ];

    protected $hidden=[
        'password','pivot'
    ];

    public function city(){
      return  $this->belongsTo(City::class,'city_id','id');
    }
    public function car(){
     return   $this->hasMany(Car::class,'client_id','id');
    }
    public function favouriteProviders(){
    return $this->belongsToMany(Provider::class,'user_favourite_providers','client_id','provider_id');
    }
}
