<?php

namespace App\Infrastructure;

use App\Domain\AppointmentRequest\AppointmentRequest;
use App\Domain\AppointmentRequest\AppointmentRequestRepository;
use App\Models\AppointmentRequestModel;

class AppointmentRequestEloquentRepository implements AppointmentRequestRepository
{
    public function findById(int $id): ?AppointmentRequest
    {
        return AppointmentRequestModel::find($id);
    }

    public function create(AppointmentRequest $appointmentRequest): void
    {
        $appointmentRequest = AppointmentRequestModel::create([
            'user_id' => $appointmentRequest->getClientId(),
            'request_date' => $appointmentRequest->getRequestDate(),
            'request_start' => $appointmentRequest->getRequestTime(),
            'reason' => $appointmentRequest->getReason(),
            'status' => $appointmentRequest->getStatus(),
        ]);
    }
}