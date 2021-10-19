<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable=[

        'name',
        'type',
        'model_id',
        'client_id',
        'chassis_number'
    ];

}