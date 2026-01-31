<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalAssistance extends Model
{
    use HasFactory;

    protected $table = 'company_advantages';

   protected $fillable = [
        'title',
        'description',
        'image'
    ];
 

    public function getImageAttribute($value)
    {
        if ($value != NULL) {
            return asset('uploads/legal-assistance/' . $value);
        }
        return null;
    }
}
