<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable=[

        'name',
        'password',
        'phone_number',
        'city_id',
        'profile_photo_path',
        'status'
    ];

    protected $hidden=[
        'password','pivot'
    ];
    public function photoUrl(){
        return Storage::url($this->profile_photo_path);
    }
    public function city(){
      return  $this->belongsTo(City::class,'city_id','id');
    }
    public function address(){
        return $this->hasMany(ClientsAddress::class,'client_id','id');
    }
    public function car(){
     return   $this->hasMany(Car::class,'client_id','id');
    }
    public function favouriteProviders(){
    return $this->belongsToMany(Provider::class,'user_favourite_providers','client_id','provider_id');
    }

}
