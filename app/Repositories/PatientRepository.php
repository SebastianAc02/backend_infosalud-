<?php


namespace App\Repositories;

use App\Models\Patient;

class PatientRepository {
    public function create(array $data): Patient {
        return Patient::create($data);
    }
    public function update(int $id, array $data): Patient {
        $patient = Patient::findOrFail($id);
        $patient->update($data);
        return $patient;
    }
    public function find(int $id): ?Patient {
        return Patient::find($id);
    }
}
