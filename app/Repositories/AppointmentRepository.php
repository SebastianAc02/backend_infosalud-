<?php


namespace App\Repositories;

use App\Models\Appointment;

class AppointmentRepository {
    public function findByUser($userId) {
        return Appointment::where('user_id', $userId)
            ->orderBy('scheduled_at', 'desc')
            ->get();
    }
    public function findById($id, $userId) {
        return Appointment::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();
    }
    public function delete($id, $userId) {
        return Appointment::where('id', $id)
            ->where('user_id', $userId)
            ->delete();
    }
}
