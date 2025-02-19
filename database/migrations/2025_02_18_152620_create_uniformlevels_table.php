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
        Schema::create('uniformlevels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uniform_id')->constrained('uniforms')->onDelete('cascade');
            $table->string('size', 10);
            $table->integer('existence')->default(0);
            $table->integer('departure')->default(0);
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uniformlevels');
    }
};
