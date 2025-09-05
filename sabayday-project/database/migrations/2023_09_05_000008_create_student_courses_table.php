<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('student_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->enum('semester', ['1st', '2nd', 'summer']);
            $table->decimal('grade', 5, 2)->nullable();
            $table->enum('status', ['enrolled', 'completed', 'dropped'])->default('enrolled');
            $table->timestamps();

            $table->unique(['student_id', 'course_id', 'academic_year_id', 'semester'], 'sc_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_courses');
    }
}
