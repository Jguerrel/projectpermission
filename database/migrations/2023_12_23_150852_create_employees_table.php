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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name',20)->nullable(false);
            $table->string('lastname',20)->nullable(false);
            $table->unsignedBigInteger('compania_id');
            $table->foreign('compania_id')->references('id')->on('companias');
            $table->unsignedBigInteger('departamento_id');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
