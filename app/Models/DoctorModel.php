<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorModel extends Model
{
    protected $table = 'doctors';

    protected $fillable = [
        'user_id',
        'speciality_id',
        'consultation_duration_minutes',
    ];
}