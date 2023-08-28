<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id') ;
            $table->string('name') ;
            $table->enum('gender', ['Pria', 'Wanita'])->nullable(); // Membuat kolom 'gender' dapat bernilai null
            $table->date('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('nationality');
            $table->string('education');
            $table->text('interest')->nullable();
            $table->text('photo')->nullable();
            $table->enum('status', ['Aktif', 'Tidak'])->default('Tidak');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
