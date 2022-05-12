<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class,'main_category_id','id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

    public function subSubCategoryDocuments()
    {
        return $this->hasMany(SubSubCategoryDocument::class,'sub_sub_category_id','id');
    }
}
