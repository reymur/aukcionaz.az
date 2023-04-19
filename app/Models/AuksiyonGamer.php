<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuksiyonGamer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function auksiyon() {
        return $this->belongsTo(Auksiyon::class);
    }
}
