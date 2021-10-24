<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCancellation extends Model
{
    use HasFactory;

    public function reason(){
        return $this->belongsTo(CancellationReasons::class,'cancel_id','id');
    }
}
