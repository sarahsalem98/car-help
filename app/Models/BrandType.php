<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BrandType extends Model
{
    use HasFactory;
    protected $hidden=['pivot'];
    protected $fillable=[
        'name',
        'name_en',
        'picture'
    ];
    public function photoUrl(){
        return Storage::url($this->picture);
    }
}
