<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipTaskTable extends Migration
{
    public function up()
    {
        Schema::create('internship_task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('internship_id');
            $table->timestamps();
           
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('internship_id')->references('id')->on('internships')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('internship_task');
    }
}

