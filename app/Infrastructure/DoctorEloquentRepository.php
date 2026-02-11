<?php

namespace App\Infrastructure;

use App\Domain\Doctor\Doctor;
use App\Domain\Doctor\DoctorRepository;
use App\Models\DoctorModel;

class DoctorEloquentRepository implements DoctorRepository
{
    public function findById(int $id)
    {
        $model = DoctorModel::find($id);
        if (!$model) {
            return null;
        }

        $model = Doctor::reconstitute($model->id, $model->user_id, $model->consultation_duration_minutes);

        return $model;
    }
}