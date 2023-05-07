<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuksiyonGamer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function auksiyon() {
        return $this->belongsTo(Auksiyon::class );
    }

    public function phone(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Phone::class, 'phoneable_id', 'user_id' );
    }
}
