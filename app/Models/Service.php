<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;
    protected $fillable=[
    'name',
    'name_en',
    'service_photo_path'
    ];
    public function photoUrl(){
        return Storage::url($this->service_photo_path);
    }
    public function subservice(){
        return $this->hasMany(SubServices::class);
    }
}
