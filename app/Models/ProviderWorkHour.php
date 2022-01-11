<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderWorkHour extends Model
{
    use HasFactory;
    protected $fillable  = [
        'day',
        'day_en',
        'from',
        'to',
        'closed'
    ];
}
