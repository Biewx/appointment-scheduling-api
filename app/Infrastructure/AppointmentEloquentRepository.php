<?php

namespace App\Infrastructure;

use App\Domain\Appointment;
use App\Domain\AppointmentRepository;
use App\Models\AppointmentModel;
use Carbon\Carbon;

class AppointmentEloquentRepository implements AppointmentRepository{
    public function create(Appointment $appointment): void{
        $appointment = AppointmentModel::create([
            'appointment_request_id' => $appointment->getAppointmentRequestId(),
            'doctor_id' => $appointment->getDoctorId(),
            'start_time' => $appointment->getStartDateTime()->toDateTimeString(),
            'end_time' => $appointment->getEndDateTime()->toDateTimeString()
        ]);
    }

    public function getAvailability(int $doctorId, Carbon $startDateTime, Carbon $endDateTime)
    {
        $availability = AppointmentModel::where('doctor_id', $doctorId)
        ->where('start_time', '>', $startDateTime->toDateTimeString())
        ->where('end_time', '<', $endDateTime->toDateTimeString())
        ->doesntExist();
        return $availability;
    }
}