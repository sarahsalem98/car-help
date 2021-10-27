<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $hidden=['pivot'];
    protected $fillable = [
        'provider_id',
        'address_id',
        'payement_method',
        'order_type',
        'car_id',
        'details',
        'images'
    ];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function price()
    {
        return $this->hasMany(OrderPrice::class, 'order_id', 'id');
    }
    public function cancel()
    {
        return $this->hasOne(ClientCancellation::class, 'cancel_id', 'id');
    }
    public function product(){
        return $this
        ->belongsToMany(Product::class,'product_orders','order_id','product_id')
        ->withPivot('product_id','order_id','qty','total_price')
        ->withTimestamps();
    }
}
