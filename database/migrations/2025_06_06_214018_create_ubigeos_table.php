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
        Schema::create('emp_ciudad_ubigeo', function (Blueprint $table) {
            $table->id('ubi_id');
            $table->string('ubi_departamento')->nullable();
            $table->string('ubi_provincia')->nullable();
            $table->string('ubi_distrito')->nullable();
            $table->unsignedBigInteger('ubi_depid')->index()->nullable();
            $table->unsignedBigInteger('ubi_provid')->index()->nullable();
            $table->unsignedBigInteger('ubi_distid')->index()->nullable();

            


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubigeos');
    }
};
