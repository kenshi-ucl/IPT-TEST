<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('cascade');
            $table->foreignId('evaluator_id')->constrained('students')->onDelete('cascade');
            $table->enum('semester', ['1st', '2nd', 'summer']);
            $table->timestamp('evaluation_date');
            $table->json('criteria_scores');
            $table->text('comments')->nullable();
            $table->decimal('total_score', 5, 2);
            $table->enum('status', ['submitted', 'reviewed'])->default('submitted');
            $table->timestamps();

            $table->unique(['academic_year_id', 'course_id', 'faculty_id', 'evaluator_id', 'semester'], 'eval_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
