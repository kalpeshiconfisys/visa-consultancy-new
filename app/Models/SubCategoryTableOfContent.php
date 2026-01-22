<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryTableOfContent extends Model
{
    protected $fillable = [
        'category_id',
        'visa_sub_category_id',
        'title',
        'description',
        'bullets',
        'type'
    ];

    protected $casts = [
        'bullets' => 'array',
    ];
    protected $hidden = ['created_at', 'updated_at','deleted_at', 'bullets'];

}
