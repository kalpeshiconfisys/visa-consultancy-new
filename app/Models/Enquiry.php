<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'visa_id',
        'message',
    ];

    public function visa_category()
    {
        return $this->belongsTo(VisaCategory::class, 'visa_id' , 'id');
    }
}
