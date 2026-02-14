<?php

namespace App\Infrastructure;

use App\Domain\Appointment;
use App\Domain\AppointmentRepository;
use App\Models\AppointmentModel;
use Carbon\Carbon;

class AppointmentEloquentRepository implements AppointmentRepository{

    public function findById(int $id)
    {
        $model = AppointmentModel::find($id);
        if(!$model){
            return null;
        }
        $appointment = Appointment::reconstitute(
            $model->id,
            $model->appointment_request_id,
            $model->doctor_id,
            $model->status,
            $model->start_time,
            $model->end_time
        );

        return $appointment;

    }

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

    public function update(Appointment $appointment): void{
        AppointmentModel::where('id', $appointment->getId())->update([
            'status' => $appointment->getStatus(),
        ]);
    }
}