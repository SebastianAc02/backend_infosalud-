<?php
namespace App\Listeners;
use App\Events\SymptomReported;
use App\Models\Alert;
class CreateAlertForSymptomReported {
    public function handle(SymptomReported $event) {
        Alert::create([
            'patient_id' => $event->patientId,
            'type' => 'symptom-reported',
            'message' => $event->symptom,
            'status' => 'pending'
        ]);
    }
}
