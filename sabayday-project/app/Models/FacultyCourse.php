<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'course_id',
        'academic_year_id',
        'semester',
        'status'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
