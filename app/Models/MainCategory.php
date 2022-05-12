<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subSubCategories()
    {
        return $this->hasMany(SubSubCategory::class,'main_category_id','id');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class,'main_category_id','id');
    }
}
