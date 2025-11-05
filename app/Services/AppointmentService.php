<?php


namespace App\Services;

use App\Repositories\AppointmentRepository;
use App\Models\Appointment;

class AppointmentService {
    protected $repo;
    public function __construct(AppointmentRepository $repo) {
        $this->repo = $repo;
    }

    public function getUserAppointments($userId) {
        return $this->repo->findByUser($userId);
    }
    public function getAppointment($id, $userId) {
        return $this->repo->findById($id, $userId);
    }
    public function create($userId, $data) {
        $data['user_id'] = $userId;
        return Appointment::create($data);
    }
    public function update($id, $userId, $data) {
        $appointment = $this->repo->findById($id, $userId);
        $appointment->update($data);
        return $appointment->fresh();
    }
    public function delete($id, $userId) {
        return $this->repo->delete($id, $userId);
    }
}


