<?php

namespace App\Domain;

use App\Models\AppointmentModel;

class Appointment
{
    private ?int $id = null;
    private ?int $doctorId = null;
    private ?int $appointmentRequestId = null;
    private ?string $startDateTime = null;
    private ?string $endDateTime = null;

    public const STATUS_SCHEDULED = 'SCHEDULED';
    public const STATUS_CANCELED = 'CANCELED';
    public const STATUS_COMPLETED = 'COMPLETED';

    public function __construct(
        ?int $doctorId,
        ?int $appointmentRequestId,
        ?string $startDateTime,
        ?string $endDateTime
    ){
    }
}