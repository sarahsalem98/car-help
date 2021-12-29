<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $hidden = ['pivot'];
    protected $fillable = [
        'provider_id',
        'address_id',
        'payement_method',
        'order_type',
        'car_id',
        'details',
        'images'
    ];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

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
    public function clientCancel()
    {
        return $this->hasOne(ClientCancellation::class, 'cancel_id', 'id');
    }
    public function providerCancel()
    {
        return $this->hasOne(ProviderCancellation::class, 'cancel_id', 'id');
    }
    public function firstImageUrl()
    {
        if ($this->images == null) {

            return null;
        } else {

            $image = json_decode($this->images)[0];
            return Storage::url($image);
        }
    }
    public function product()
    {
        return $this
            ->belongsToMany(Product::class, 'product_orders', 'order_id', 'product_id')
            ->withPivot('product_id', 'order_id', 'qty', 'total_price')
            ->withTimestamps();
    }
    public function address()
    {
        return $this->belongsTo(ClientsAddress::class, 'address_id', 'id');
    }
    public function comment()
    {
        return $this->hasOne(CommentAndRate::class);
    }
    public function providerHasPrice($provider_id)
    {

        return $this->price->contains($provider_id);
    }
    public function providerHasCanceled($provider_id)
    {

        return $this->hasOne->contains($provider_id);
    }
}
