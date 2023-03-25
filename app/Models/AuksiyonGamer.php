<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuksiyonGamer extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id','aukcion_id','price','position'];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function aukcion() {
        return $this->belongsTo(Aukcion::class);
    }
}
