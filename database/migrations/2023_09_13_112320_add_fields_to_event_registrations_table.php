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
        Schema::table('event_registrations', function (Blueprint $table) {
            //
            $table->string('name'); // Tambahkan field name
            $table->string('email'); // Tambahkan field email
            $table->string('phone'); // Tambahkan field phone
            $table->string('activity'); // Tambahkan field activity
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            //
        });
    }
};
