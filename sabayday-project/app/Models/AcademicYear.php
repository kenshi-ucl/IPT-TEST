<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'start_date',
        'end_date',
        'is_current',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean'
    ];

    public function facultyCourses()
    {
        return $this->hasMany(FacultyCourse::class);
    }

    public function studentCourses()
    {
        return $this->hasMany(StudentCourse::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
