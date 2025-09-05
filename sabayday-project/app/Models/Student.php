<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'student_id',
        'year_level',
        'program',
        'status',
        'admission_date'
    ];

    protected $casts = [
        'admission_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses')
            ->withPivot('academic_year_id', 'semester', 'grade')
            ->withTimestamps();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'evaluator_id');
    }
}
