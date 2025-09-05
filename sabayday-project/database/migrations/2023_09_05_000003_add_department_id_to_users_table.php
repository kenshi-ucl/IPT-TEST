<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('role', ['admin', 'faculty', 'student'])->default('student');
            $table->string('profile_image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('last_login_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn(['department_id', 'role', 'profile_image', 'status', 'last_login_at']);
        });
    }
}
