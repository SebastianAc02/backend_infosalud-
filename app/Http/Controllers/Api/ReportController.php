<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;

class ReportController extends Controller {
    public function appointmentStats(Request $request) {
        $confirmed = Appointment::where('status', 'completed')->count();
        $lost = Appointment::where('status', 'cancelled')->count();
        return response()->json([
            'confirmed' => $confirmed,
            'lost' => $lost
        ]);
    }
    public function patientAdherence(Request $request, $patientId) {
        $total = Appointment::where('user_id', $patientId)->count();
        $attended = Appointment::where('user_id', $patientId)
            ->where('status', 'completed')->count();
        $rate = $total ? round($attended * 100 / $total, 1) : 0;
        return response()->json([
            'adherence_rate_percent' => $rate,
            'total_appointments' => $total,
            'attended_appointments' => $attended
        ]);
    }
}
