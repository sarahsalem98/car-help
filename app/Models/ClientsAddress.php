<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsAddress extends Model
{
    use HasFactory;
    protected $fillable=[

        'lat',
        'long',
        'address',
        'client_id'
    ];

}
