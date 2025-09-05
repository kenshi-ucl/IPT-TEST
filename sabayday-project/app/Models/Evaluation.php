<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'course_id',
        'faculty_id',
        'evaluator_id',
        'semester',
        'evaluation_date',
        'criteria_scores', // JSON field storing scores for different criteria
        'comments',
        'total_score',
        'status'
    ];

    protected $casts = [
        'evaluation_date' => 'datetime',
        'criteria_scores' => 'array'
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function evaluator()
    {
        return $this->belongsTo(Student::class, 'evaluator_id');
    }
}
