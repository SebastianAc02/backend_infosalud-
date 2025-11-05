<?php



namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClinicalHistory;
use App\Models\Patient;
use App\Http\Resources\ClinicalHistoryResource;

class ClinicalHistoryController extends Controller {
    public function store(Request $request, $patientId) {
        $data = $request->validate([
            'doctor_id' => 'nullable|integer',
            'symptom_summary' => 'nullable|string',
            'visit_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);
        $data['patient_id'] = $patientId;
        $history = ClinicalHistory::create($data);
        return new ClinicalHistoryResource($history);
    }
    public function index($patientId) {
        $list = ClinicalHistory::where('patient_id', $patientId)
            ->orderBy('visit_date', 'desc')->get();
        return ClinicalHistoryResource::collection($list);
    }
    public function show($id) {
        $record = ClinicalHistory::findOrFail($id);
        return new ClinicalHistoryResource($record);
    }
}
