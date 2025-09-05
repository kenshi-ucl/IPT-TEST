<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyTable extends Migration
{
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('employee_id')->unique();
            $table->string('position');
            $table->string('specialization')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->date('hire_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faculties');
    }
}
