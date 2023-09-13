<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('chuyen', function (Blueprint $table) {
            $table->bigIncrements('idchuyen');
            $table->string('diemdung', 255);
            $table->string('diemxuatphat', 255);
            $table->unsignedBigInteger('idxe');
            $table->unsignedBigInteger('idadmin');
            $table->unsignedBigInteger('idtuyen');
            $table->foreign('idxe')->references('idxe')->on('xe');
            $table->foreign('idadmin')->references('idadmin')->on('admin');
            $table->foreign('idtuyen')->references('idtuyen')->on('tuyen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('chuyen');

    }
};
