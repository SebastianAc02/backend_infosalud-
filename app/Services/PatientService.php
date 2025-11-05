<?php
namespace App\Services;

use App\Repositories\PatientRepository;
use App\Models\Patient;

class PatientService {
    protected $repo;
    public function __construct(PatientRepository $repo) {
        $this->repo = $repo;
    }
    // Affiliation validation stub
    public function validateAffiliation(array $data): bool {
        // MVP: accept all; expand logic later
        return true;
    }
    public function register(array $data): Patient {
        if (!$this->validateAffiliation($data)) {
            throw new \Exception('Affiliation invalid.');
        }
        return $this->repo->create($data);
    }
    public function updateContact(int $id, array $data): Patient {
        return $this->repo->update($id, $data);
    }
    public function updateDiagnosis(int $id, array $data): Patient {
        return $this->repo->update($id, $data);
    }
    public function get(int $id): ?Patient {
        return $this->repo->find($id);
    }
}
