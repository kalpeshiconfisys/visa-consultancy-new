<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'designation'
    ];

     public function getImageAttribute($value)
    {
        if ($value != NULL) {
            return asset('uploads/our-team/' . $value);
        }
        return null;
    }

}
