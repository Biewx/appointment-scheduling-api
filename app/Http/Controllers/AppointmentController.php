<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Appointment\CompleteAppointment;

class AppointmentController extends Controller
{
    public function completeAppointment(int $id, CompleteAppointment $completeAppointment) {
        $result = $completeAppointment->complete($id);
        return response()->json(['msg' => 'Appointment completed successfully', 200]);
    }
}