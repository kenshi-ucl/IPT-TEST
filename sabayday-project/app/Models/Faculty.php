<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';

    protected $fillable = [
        'user_id',
        'department_id',
        'employee_id',
        'position',
        'specialization',
        'status',
        'hire_date'
    ];

    protected $casts = [
        'hire_date' => 'date'
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
        return $this->belongsToMany(Course::class, 'faculty_courses')
            ->withPivot('academic_year_id', 'semester')
            ->withTimestamps();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
    
    public function grades()
    {
        return $this->belongsToMany(grades::class, 'faculty_courses')
            ->withPivot('academic_year_id', 'semester')
            ->withTimestamps();
    }
}
