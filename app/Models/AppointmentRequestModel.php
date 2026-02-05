<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentRequestModel extends Model
{
    protected $table = 'appointment_requests';

    protected $fillable = [
        'user_id',
        'request_date',
        'request_start',
        'status',
        'reason',
    ];
}