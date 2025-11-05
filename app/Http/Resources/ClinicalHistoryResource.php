<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class ClinicalHistoryResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'visit_date' => $this->visit_date,
            'symptom_summary' => $this->symptom_summary,
            'notes' => $this->notes,
            'created_at' => $this->created_at
        ];
    }
}
