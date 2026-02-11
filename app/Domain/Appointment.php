<?php

namespace App\Domain;

use App\Models\AppointmentModel;
use Carbon\Carbon;
use DomainException;

class Appointment
{
    private ?int $id = null;
    private ?int $doctorId = null;
    private ?int $appointmentRequestId = null;
    private Carbon $startsAt;
    private Carbon $endAt;
    private ?string $status = null;

    public const STATUS_SCHEDULED = 'SCHEDULED';
    public const STATUS_CANCELED = 'CANCELED';
    public const STATUS_COMPLETED = 'COMPLETED';

    public function __construct(){}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoctorId(): ?int
    {
        return $this->doctorId;
    }

    public function getAppointmentRequestId(): ?int
    {
        return $this->appointmentRequestId;
    }

    public function getStartDateTime(): ?Carbon
    {
        return $this->startsAt;
    }

    public function getEndDateTime(): ?Carbon
    {
        return $this->endAt;
    }

    public static function createNewAppointment(
        int $doctorId,
        int $appointmentRequestId,
        Carbon $startDateTime,
        Carbon $endDateTime
    ){
        if($startDateTime > $endDateTime) {
            throw new DomainException('Start date must be before end date');
        }
        if($startDateTime < Carbon::now()) {
            throw new DomainException('Start date must be in the future');
        }

        if(!$doctorId){
            throw new DomainException('Doctor ID is required');
        }

        if (!$appointmentRequestId){
            throw new DomainException('Appointment request ID is required');
        }
        
        $appointment = new self();
        $appointment->doctorId = $doctorId;
        $appointment->appointmentRequestId = $appointmentRequestId;
        $appointment->startsAt = $startDateTime;
        $appointment->endAt = $endDateTime;
        $appointment->status = self::STATUS_SCHEDULED;
        return $appointment;

    }
}