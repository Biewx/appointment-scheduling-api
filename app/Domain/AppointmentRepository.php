<?php

namespace App\Domain;

use App\Domain\Appointment;

interface AppointmentRepository{
    public function create(Appointment $appointment): void;
}