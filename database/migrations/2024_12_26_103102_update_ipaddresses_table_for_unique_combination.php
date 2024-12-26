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
        Schema::table('ipaddresses', function (Blueprint $table) {

            // Crear un índice único compuesto para `ip` y `branch_office_id`
            $table->unique(['ip', 'branch_office_id'], 'unique_ip_branch_office');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ipaddresses', function (Blueprint $table) {
            $table->dropUnique('unique_ip_branch_office');


        });
    }
};
