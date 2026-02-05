<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'appointment_request_id',
        'doctor_id',
        'status',
        'date',
        'start_time',
        'end_time',
    ];
}