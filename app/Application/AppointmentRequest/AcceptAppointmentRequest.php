<?php

namespace App\Application\AppointmentRequest;

use App\Domain\Appointment;
use App\Domain\AppointmentRepository;
use App\Domain\AppointmentRequest\AppointmentRequest;
use App\Domain\AppointmentRequest\AppointmentRequestRepository;
use App\Domain\Doctor\DoctorRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AcceptAppointmentRequest
{
    public function __construct(private AppointmentRequestRepository $appointmentRequestRepository, private DoctorRepository $doctorRepository, private AppointmentRepository $appointmentRepository) {}

    public function accept(int $requestId, int $doctorId)
    {
        DB::transaction(function () use ($requestId, $doctorId) {
            $appointmentRequest = $this->appointmentRequestRepository->findById($requestId);
            $requestDate = $appointmentRequest->getRequestDate();
            $requestTime = $appointmentRequest->getRequestTime();
            $doctor = $this->doctorRepository->findById($doctorId);

            $startsAt = Carbon::parse($requestDate)->setTimeFromTimeString($requestTime);
            $endAt = $startsAt->copy()->addMinutes($doctor->getDuration());

            $availability = $this->appointmentRepository->getAvailability($doctorId, $startsAt, $endAt);
            if (!$availability) {
                throw new \Exception('Already exists an appointment in this period');
            }

            $appointmentRequest = $appointmentRequest->accept();
            $this->appointmentRequestRepository->update($appointmentRequest);

            
            
            $appointment = Appointment::createNewAppointment($doctorId, $appointmentRequest->getId(), $startsAt, $endAt);
            $this->appointmentRepository->create($appointment);
            
        });

        return true;
    }
}