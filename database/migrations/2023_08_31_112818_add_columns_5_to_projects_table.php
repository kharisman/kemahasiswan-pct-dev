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
        Schema::table('projects', function (Blueprint $table) {
            //
            $table->enum('level', ['Mudah', 'Sedang', 'Susah'])->default('Mudah');
            $table->date('registration_start_at')->nullable();
            $table->date('registration_end_at')->nullable();
            $table->date('work_start_at')->nullable();
            $table->date('work_end_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['level', 'registration_start_at', 'registration_end_at', 'work_start_at', 'work_end_at']);
        });
    
    }
};
