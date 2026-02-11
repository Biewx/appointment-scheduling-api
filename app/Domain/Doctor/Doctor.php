<?php

namespace App\Domain\Doctor;

use App\Models\DoctorModel;
use DomainException;

class Doctor
{
    private ?int $id = null;
    private ?int $userId = null;
    private ?int $specialtyId = null;
    private ?int $consultationDurationMinutes = null;


    public static function reconstitute(
        int $id,
        int $userId,
        int $consultationDurationMinutes
    ){
        $doctor = new self();
        $doctor->id = $id;
        $doctor->userId = $userId;
        $doctor->consultationDurationMinutes = $consultationDurationMinutes;
        return $doctor;
    }

    public function getDuration()
    {
        return $this->consultationDurationMinutes;
    }
}