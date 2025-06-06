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
        Schema::create('emp_tarifario_grupos', function (Blueprint $table) {
            $table->id('ta_id');
            $table->unsignedBigInteger('ta_ubigeo')->index()->nullable();
            $table->unsignedBigInteger('ta_id_departamento')->index()->nullable();
            $table->unsignedBigInteger('ta_id_provincia')->index()->nullable();
            $table->unsignedBigInteger('ta_id_distrito')->index()->nullable();
            $table->unsignedBigInteger('ta_id_tarifa')->index()->nullable();
            $table->unsignedBigInteger('ta_id_tarifa_reparto')->index()->nullable();
           

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifario_grupos');
    }
};
