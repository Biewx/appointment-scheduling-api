<?php

namespace App\Application\AppointmentRequest;

use App\Domain\AppointmentRequest\AppointmentRequestRepository;
use App\Domain\AppointmentRequest\AppointmentRequest;

class RejectAppointmentRequest
{
    public function __construct(private AppointmentRequestRepository $appointmentRequestRepository)
    {
    }

    public function reject(int $requestId, ?string $reason) {
        $appointmentRequest = $this->appointmentRequestRepository->findById($requestId);
        $appointmentRequest = $appointmentRequest->reject($reason);
        $this->appointmentRequestRepository->update($appointmentRequest);
        return true;
    }
}