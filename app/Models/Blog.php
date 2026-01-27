<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
    ];


    public function getImageAttribute($value)
    {
        if ($value != NULL) {
            return asset('uploads/blogs/' . $value);
        }
        return null;
    }

}

