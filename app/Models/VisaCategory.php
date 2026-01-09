<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisaCategory extends Model
{

    protected $table = "visa_categories";

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'image',
        'category_logo',
        'bullets',
        'publish_is',
        'date_modified',
    ];

    protected $casts = [
        'bullets' => 'array'
    ];

    public function getImageAttribute($value)
    {
        if ($value != NULL) {
            return asset('uploads/visa-category/' . $value);
        }
        return null;
    }

    public function getCategoryLogoAttribute($value)
    {
        if ($value != NULL) {
            return asset('uploads/category_logo/' . $value);
        }
        return null;
    }

    public function sub_category()
    {
        return $this->hasMany(VisaSubCategory::class, 'category_id' , 'id');
    }

    public function main_table_of_content()
    {
        return $this->hasMany(SubCategoryTableOfContent::class, 'category_id' , 'id');
    }
}
