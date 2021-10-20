<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
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
}
