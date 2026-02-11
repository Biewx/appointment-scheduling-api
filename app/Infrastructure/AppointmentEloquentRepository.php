<?php

namespace App\Infrastructure;

use App\Domain\Appointment;
use App\Domain\AppointmentRepository;
use App\Models\AppointmentModel;

class AppointmentEloquentRepository implements AppointmentRepository{
    public function create(Appointment $appointment): void{
        $appointment = AppointmentModel::create([
            'appointment_request_id' => $appointment->getAppointmentRequestId(),
            'doctor_id' => $appointment->getDoctorId(),
            'start_time' => $appointment->getStartDateTime()->toDateTimeString(),
            'end_time' => $appointment->getEndDateTime()->toDateTimeString()
        ]);
    }
}