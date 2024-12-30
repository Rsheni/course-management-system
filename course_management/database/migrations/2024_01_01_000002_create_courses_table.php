<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructor_id'); // who created the course
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('subject')->nullable();
            $table->string('enrollment_key', 4); // 4-digit code
            $table->timestamps();

            // foreign key
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}