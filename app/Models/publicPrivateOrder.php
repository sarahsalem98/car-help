<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publicPrivateOrder extends Model
{
    use HasFactory;
    protected $fillable=[
'car_id',
'details',
'images'
    ];

    public function provider(){
        return $this->belongsTo(Provider::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function price(){
        return $this->hasMany(OrderPrice::class,'order_id','id');
    }
    public function cancel(){
        return $this->hasOne(ClientCancellation::class,'cancel_id','id');
    }
}
