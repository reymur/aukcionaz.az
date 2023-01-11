<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioVeVideo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(){
        return $this->morphMany(Product::class, 'productable');
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }
}
