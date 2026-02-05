<?php

namespace App\Application\AppointmentRequest;

use App\Domain\AppointmentRequest\AppointmentRequestRepository;
use App\Domain\AppointmentRequest\AppointmentRequest;

class CreateAppointmentRequest {
    public function __construct(private AppointmentRequestRepository $appointmentRequestRepository) {}

    public function create(int $clientId, string $requestDate, string $requestTime, ?string $reason = null) {
        $appointmentRequest = AppointmentRequest::createNewAppointmentRequest($clientId, $requestDate, $requestTime, $reason);
        $this->appointmentRequestRepository->create($appointmentRequest);
        return $appointmentRequest;
    }

}