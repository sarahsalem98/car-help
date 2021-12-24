<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'name_en'
    ];
    public function car(){
        return $this->hasMany(Car::class,'model_id','id');
    }
}
