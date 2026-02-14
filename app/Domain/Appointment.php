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

    public function getStatus(): ?string
    {
        return $this->status;
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

    public static function reconstitute(int $id, int $appointmentRequestId, int $doctorId, string $status, Carbon $startDateTime, Carbon $endDateTime): self{
        $appointment = new self();
        $appointment->id = $id;
        $appointment->doctorId = $doctorId;
        $appointment->appointmentRequestId = $appointmentRequestId;
        $appointment->startsAt = $startDateTime;
        $appointment->endAt = $endDateTime;
        $appointment->status = $status; 
        return $appointment;
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

    public function completeAppointment(){
        if($this->status !== self::STATUS_SCHEDULED){
            throw new DomainException('Appointment is not scheduled');
        }
        $this->status = self::STATUS_COMPLETED;
    }
}