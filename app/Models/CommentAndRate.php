<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentAndRate extends Model
{
    use HasFactory;
    protected $fillable=[
'rate',
'comment',
'provider_id',
'order_id'
    ];
}
