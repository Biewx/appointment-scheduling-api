<?php

namespace App\Domain\Doctor;

use App\Models\DoctorModel;

interface DoctorRepository
{
    public function findById(int $id);
}