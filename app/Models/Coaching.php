<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coaching extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image'
    ];

    public function getImageAttribute($value)
    {
        if ($value != NULL) {
            return asset('uploads/coaching/' . $value);
        }
        return null;
    }
}
