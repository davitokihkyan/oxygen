<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'name',
        'status',
        'date',
        'start_time',
        'end_time'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
