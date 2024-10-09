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
        Schema::table('devices', function (Blueprint $table) {
              // Agregar nuevos campos
              $table->unsignedBigInteger('brand_id');
              $table->foreign('brand_id')->references('id')->on('brands');
              $table->unsignedBigInteger('carmodel_id');
              $table->foreign('carmodel_id')->references('id')->on('carmodels');
              $table->unsignedBigInteger('operatingsystem_id');
              $table->foreign('operatingsystem_id')->references('id')->on('operatingsystems');
              $table->unsignedBigInteger('diskstorage_id');
              $table->foreign('diskstorage_id')->references('id')->on('diskstorages');
              $table->unsignedBigInteger('microsoftoffice_id');
              $table->foreign('microsoftoffice_id')->references('id')->on('microsoftoffices');


            // Eliminar campos existentes
            $table->dropColumn('brand');
            $table->dropColumn('model');
            $table->dropColumn('OS');
            $table->dropColumn('disco');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            // Revertir la eliminación de campos
                $table->string('brand');
                $table->string('model');
                $table->string('OS');
                $table->string('disco');

                // Eliminar los campos que fueron agregados en el método up()
                $table->dropForeign('brand_id');
                $table->dropForeign('carmodel_id');
                $table->dropForeign('operatingsystem_id');
                $table->dropForeign('diskstorage_id');
                $table->dropForeign('microsoftoffice_id');
        });
    }
};
