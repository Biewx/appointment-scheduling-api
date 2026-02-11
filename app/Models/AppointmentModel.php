<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentModel extends Model
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

    protected $dateFormat = 'Y-m-d H:i:s';
}