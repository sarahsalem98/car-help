<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class More extends Model
{
    use HasFactory;
    public function BannerUrl(){
        return Storage::url($this->banners_pics);
    }
}
