<?php

namespace App\Infrastructure;

use App\Domain\AppointmentRequest\AppointmentRequest;
use App\Domain\AppointmentRequest\AppointmentRequestRepository;
use App\Models\AppointmentRequestModel;

class AppointmentRequestEloquentRepository implements AppointmentRequestRepository
{
    public function findById(int $id)
    {
        $model = AppointmentRequestModel::find($id);
        if(!$model){
            return null;
        }
        $appointmentRequest = AppointmentRequest::reconstitute(
            $model->id,
            $model->user_id,
            $model->request_date,
            $model->request_start,
            $model->status,
            $model->reason
        );

        return $appointmentRequest;

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

    public function update(AppointmentRequest $appointmentRequest): void{
        AppointmentRequestModel::where('id', $appointmentRequest->getId())->update([
            'status' => $appointmentRequest->getStatus(),
            'reason' => $appointmentRequest->getReason(),
        ]);
    }
}