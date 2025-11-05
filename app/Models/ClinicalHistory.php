<?php




namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalHistory extends Model {
    use HasFactory;
    protected $fillable = [
        'patient_id', 'doctor_id', 'symptom_summary', 'visit_date', 'notes'
    ];
    public function patient() { return $this->belongsTo(Patient::class); }
    public function doctor() { return $this->belongsTo(User::class, 'doctor_id'); }
}
