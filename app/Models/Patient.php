<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'dob', 'phone', 'email',
        'affiliation_status', 'diagnosis', 'treatment_plan'
    ];
}
