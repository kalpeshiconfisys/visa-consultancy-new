<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';
    protected $fillable = [
        'name',
        'image',
        'description'
    ];

     public function getImageAttribute($value)
    {
        if ($value != NULL) {
            return asset('uploads/testimonial/' . $value);
        }
        return null;
    }

}
