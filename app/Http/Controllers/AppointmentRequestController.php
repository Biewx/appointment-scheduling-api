<?php

namespace App\Http\Controllers;

use App\Application\AppointmentRequest\AcceptAppointmentRequest;
use App\Application\AppointmentRequest\CreateAppointmentRequest;
use Illuminate\Http\Request;

class AppointmentRequestController extends Controller
{
    public function createNew(Request $request, CreateAppointmentRequest $CreateAppointmentRequest) {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'request_date' => 'required|date',
            'request_start' => 'required|date_format:H:i',
            'reason' => 'nullable|string'
        ]);

        $result = $CreateAppointmentRequest->create($validated['user_id'], $validated['request_date'], $validated['request_start'], $validated['reason']);
        if(!$result) {
            return response()->json(['error' => 'Request could not be created'], 400);
        }
        return response()->json(['msg' => 'Request created successfully', 200]);
    }

    public function acceptRequest(Request $request, AcceptAppointmentRequest $AcceptAppointmentRequest) {
        $validated = $request->validate([
            'request_id' => 'required|integer|exists:appointment_requests,id',
            'doctor_id' => 'required|integer|exists:doctors,id',
        ]);

        $result = $AcceptAppointmentRequest->accept($validated['request_id'], $validated['doctor_id']);
        if($result = false) {
            return response()->json(['error' => 'Request could not be accepted'], 400);
        }
        return response()->json(['msg' => 'Request accepted successfully', 200]);





    }
}