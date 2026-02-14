<?php

namespace App\Application\Appointment;

use App\Domain\AppointmentRepository;
use App\Domain\Appointment;

class CompleteAppointment
{
    public function __construct(private AppointmentRepository $appointmentRepository){}

    public function complete(int $appointmentId)
    {
        $appointment = $this->appointmentRepository->findById($appointmentId);
        $appointment->completeAppointment();
        $this->appointmentRepository->update($appointment);
        return true;
    }
}