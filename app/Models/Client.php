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
        'password'
    ];

    public function city(){
        $this->belongsTo(City::class,'city_id','id');
    }
    public function car(){
        $this->hasMany(Car::class,'client_id','id');
    }
}
