<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class Provider extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;
    use HasApiTokens;
    protected $guard ='providerWeb';


    protected $fillable=[
    'workshop_photo_path',
    'enginner_name',
    'workshop_name',
    'phone_number',
    'whatsapp_number',
    'email',
    'password',
    'business_registeration_file',
    'agreed',
    
    ];
    protected $hidden=[
        'password','pivot'
    ];
    public function photoUrl(){
        return Storage::url($this->workshop_photo_path);
    }
    public function registerationUrl(){
        return Storage::url($this->business_registeration_file);
    }

    public function subServices(){
     return $this->belongsToMany(SubServices::class,'provider_subservices','provider_id','subservice_id')->withTimestamps();
    }
    public function brandTypes(){
        return $this->belongsToMany(BrandType::class,'provider_brandtypes','provider_id','brandtypes_id')->withTimestamps();
       }

     public function address(){
         return $this->hasMany(providerAddress::class);
     }  
     public function workHour(){
         return $this->hasMany(ProviderWorkHour::class);
     }
     public function product(){
         return $this->hasMany(Product::class);
     }
     public function publicPrivateOrder(){
         return $this->hasMany(publicPrivateOrder::class);
     }
}
