<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'code',
        'name',
        'description',
        'units',
        'status'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function faculty()
    {
        return $this->belongsToMany(Faculty::class, 'faculty_courses')
            ->withPivot('academic_year_id', 'semester')
            ->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_courses')
            ->withPivot('academic_year_id', 'semester', 'grade')
            ->withTimestamps();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
