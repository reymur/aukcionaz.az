<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryTypeOnce extends Model
{
    use HasFactory;

    protected $fillable = ['name','sub_category_type_id'];
}
