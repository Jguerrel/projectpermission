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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('serialnumber',100)->unique()->nullable(false);
            $table->string("brand",30);
            $table->string("model",50);
            $table->integer('ram')->nullable();
            $table->string('photo',255)->nullable();
            $table->string('OS',50)->nullable();
            $table->string('disco',10)->nullable();
            $table->date('datedevicepurchase')->nullable(false);
            $table->text('devicecomment');
            $table->string('office',50)->nullable();
            $table->unsignedBigInteger('typedevice_id');
            $table->foreign('typedevice_id')->references('id')->on('typedevices');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->unsignedBigInteger('branch_office_id');
            $table->foreign('branch_office_id')->references('id')->on('branch_offices');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedBigInteger('disktype_id');
            $table->foreign('disktype_id')->references('id')->on('disktypes');
            $table->unsignedBigInteger('ipaddress_id');
            $table->foreign('ipaddress_id')->references('id')->on('ipaddresses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
