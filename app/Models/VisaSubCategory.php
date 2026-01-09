<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'bullets',
        'publish_is',
        'date_modified',
        'content_type',
    ];

    protected $casts = [
        'bullets' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(VisaCategory::class, 'category_id', 'id');
    }

    public function table_of_content()
    {
        return $this->hasMany(SubCategoryTableOfContent::class, 'visa_sub_category_id', 'id');
    }

}
