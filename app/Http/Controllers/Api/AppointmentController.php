<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AppointmentService;
use App\Http\Resources\AppointmentResource;

class AppointmentController extends Controller {
    protected $service;
    public function __construct(AppointmentService $service) {
        $this->service = $service;
    }
    public function index(Request $request) {
        $appointments = $this->service->getUserAppointments($request->user()->id);
        return AppointmentResource::collection($appointments);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'scheduled_at' => 'required|date|after:now',
            'status' => 'nullable|in:scheduled,completed,cancelled'
        ]);
        $appointment = $this->service->create($request->user()->id, $data);
        return new AppointmentResource($appointment);
    }
    public function show(Request $request, $id) {
        $appointment = $this->service->getAppointment($id, $request->user()->id);
        return new AppointmentResource($appointment);
    }
    public function update(Request $request, $id) {
        $data = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'scheduled_at' => 'date|after:now',
            'status' => 'in:scheduled,completed,cancelled'
        ]);
        $appointment = $this->service->update($id, $request->user()->id, $data);
        return new AppointmentResource($appointment);
    }
    public function destroy(Request $request, $id) {
        $this->service->delete($id, $request->user()->id);
        return response()->json(['message' => 'Appointment deleted']);
    }
}
