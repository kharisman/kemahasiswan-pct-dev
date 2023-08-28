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
        Schema::create('idukas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->text('address')->nullable(); // address dapat bernilai null
            $table->string('phone', 15)->nullable(); // phone dapat bernilai null   
            $table->enum('status', ['Aktif', 'Tidak'])->default('Tidak');
            $table->text('photo')->nullable(); // photo dapat bernilai null
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
