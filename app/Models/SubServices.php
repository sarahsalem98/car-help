<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SubServices extends Model
{
    use HasFactory;

    protected $fillable=[
'name',
'name_en',
'sub_service_photo_path',
'service_id'
    ];
    protected $hidden=['pivot'];
    public function photoUrl(){
        return Storage::url($this->sub_service_photo_path);
    }
    public function provider(){
     return $this->belongsToMany(Provider::class,'provider_subservices','subservice_id','provider_id')->withTimestamps();
    }
    public function mainService(){
        return $this->belongsTo(Service::class,'service_id','id');
    }

    
}
