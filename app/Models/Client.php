<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Auth;

class Client extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;
    use HasApiTokens;
    protected $guard ='clientWeb';

    protected $fillable=[

        'name',
        'password',
        'phone_number',
        'city_id',
        'profile_photo_path',
        'status',
        'phone_number_without_country_code',
    'country_code_name',
    'device_token'
    ];

    protected $hidden=[
        'password','pivot'
    ];
    public function photoUrl(){
        if($this->profile_photo_path==null){
            return null;
        }else{

            return Storage::url($this->profile_photo_path);
        }
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
    return $this->belongsToMany(Provider::class,'user_favourite_providers','client_id','provider_id')->withPivot('mainService_id')->withTimestamps();
    }
    public function hasFavouriteProviders($provider_id){
     
      return $this->favouriteProviders->contains($provider_id);
    }

}
