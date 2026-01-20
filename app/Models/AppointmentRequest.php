<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'preferred_date',
        'preferred_time_id',
        'consultation_method_id',
        'message'
    ];

    public function preferredtime()
    {
        return $this->belongsTo(PreferredTime::class, 'preferred_time_id', 'id');
    }
    public function consultationmethod()
    {
        return $this->belongsTo(ConsultationMethod::class, 'consultation_method_id', 'id');
    }
}
