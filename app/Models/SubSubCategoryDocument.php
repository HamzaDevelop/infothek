<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategoryDocument extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subSubCategory()
    {
        return $this->belongsTo(SubSubCategory::class,'sub_sub_category_id','id');
    }
}
