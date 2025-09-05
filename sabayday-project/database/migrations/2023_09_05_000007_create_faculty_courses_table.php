<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('faculty_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->enum('semester', ['1st', '2nd', 'summer']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->unique(['faculty_id', 'course_id', 'academic_year_id', 'semester'], 'fc_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('faculty_courses');
    }
}
