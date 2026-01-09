<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryTableOfContent extends Model
{
    protected $fillable = [
        'visa_sub_category_id',
        'title',
        'description',
        'bullets'
    ];

    protected $casts = [
        'bullets' => 'array',
    ];
}
