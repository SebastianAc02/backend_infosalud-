<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PatientService;
use App\Http\Resources\PatientResource;

class PatientController extends Controller {
    protected $service;
    public function __construct(PatientService $service) {
        $this->service = $service;
    }
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'affiliation_status' => 'nullable|string',
        ]);
        $patient = $this->service->register($data);
        return new PatientResource($patient);
    }
    public function update(Request $request, $id) {
        $data = $request->validate([
            'phone' => 'nullable|string',
            'email' => 'nullable|email'
        ]);
        $patient = $this->service->updateContact($id, $data);
        return new PatientResource($patient);
    }
    public function updateDiagnosis(Request $request, $id) {
        $data = $request->validate([
            'diagnosis' => 'nullable|string',
            'treatment_plan' => 'nullable|string'
        ]);
        $patient = $this->service->updateDiagnosis($id, $data);
        return new PatientResource($patient);
    }
    public function show($id) {
        $patient = $this->service->get($id);
        return new PatientResource($patient);
    }


    public function reportSymptom(Request $request, $id) {
        $data = $request->validate([
            'symptom' => 'required|string|max:255'
        ]);
        event(new SymptomReported($id, $data['symptom']));
        return response()->json(['message' => 'Symptom reported & alert created'], 201);
    }
    public function alerts($id) {
        $alerts = \App\Models\Alert::where('patient_id', $id)->orderBy('created_at', 'desc')->get();
        return AlertResource::collection($alerts);
    }
}
