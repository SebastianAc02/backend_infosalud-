<?php
namespace App\Events;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class SymptomReported {
    use Dispatchable, SerializesModels;
    public $patientId;
    public $symptom;
    public function __construct($patientId, $symptom) {
        $this->patientId = $patientId;
        $this->symptom = $symptom;
    }
}
