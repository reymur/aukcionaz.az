<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioVeVideo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function products(){
        return $this->morphMany(Product::class, 'productable');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function phones(){
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function productWithAll(){
        return $this->hasOne(__CLASS__,'id')->with(['images','phones']);
    }
}
