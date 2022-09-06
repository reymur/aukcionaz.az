<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AukcionUsers extends Model
{
    use HasFactory;

    protected $table = 'aukcion_people';
    protected $fillable = ['name','sum','position'];
}
