<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'dob' => $this->dob,
            'phone' => $this->phone,
            'email' => $this->email,
            'affiliation_status' => $this->affiliation_status,
            'diagnosis' => $this->diagnosis,
            'treatment_plan' => $this->treatment_plan,
        ];
    }
}
