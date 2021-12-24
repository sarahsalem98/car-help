<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $hidden=['pivot'];
    protected $fillable=[
        'category_id',
        'name',
        'details',
        'price',
        'price_after_discount',
        'qty',
        'images'
        ];

        public function category(){
            return $this->belongsTo(Category::class);
        }
        public function cart(){
            return $this->hasMany(Cart::class);
        }
        public function order(){
            return $this->belongsToMany(Order::class,'product_orders','product_id','order_id')->withTimestamps();
        }
        public function firstImageUrl(){
            $image= json_decode( $this->images)[0];
             return Storage::url( $image);
        }
        public function secondImageUrl(){
            $image= json_decode( $this->images)[1];
            return Storage::url( $image);
        }
        public function provider(){
            return $this->belongsTo(Provider::class);
        }
}
