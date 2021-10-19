<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderWorkHour extends Model
{
    use HasFactory;
    protected $fiilable = [
        'day',
        'from',
        'to',
        'closed'
    ];
}
