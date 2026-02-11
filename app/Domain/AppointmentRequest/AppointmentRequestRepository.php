<?php

namespace App\Domain\AppointmentRequest;


interface AppointmentRequestRepository{
    public function findById(int $id);
    public function create(AppointmentRequest $appointmentRequest):void;
    public function update(AppointmentRequest $appointmentRequest):void;
}