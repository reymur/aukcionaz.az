<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sub_category_id'];
}
