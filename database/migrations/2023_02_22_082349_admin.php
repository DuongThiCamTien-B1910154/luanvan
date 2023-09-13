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
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('idadmin');
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('mand', 255);
            $table->string('namsinh', 255);
            $table->string('level', 255);
            $table->unsignedBigInteger('idcv');
            $table->unsignedBigInteger('idnd');
            $table->foreign('idcv')->references('idcv')->on('chucvu');
            $table->foreign('idnd')->references('idnd')->on('nguoidung');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');

    }
};
