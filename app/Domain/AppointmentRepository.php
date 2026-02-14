<?php

namespace App\Domain;

use App\Domain\Appointment;
use Carbon\Carbon;

interface AppointmentRepository{
    public function create(Appointment $appointment): void;
    public function getAvailability(int $doctorId, Carbon $startDateTime, Carbon $endDateTime);
    public function findById(int $id);
    public function update(Appointment $appointment): void;
}