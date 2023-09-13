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
        Schema::create('chucvu', function (Blueprint $table) {
            $table->bigIncrements('idcv');
            $table->string('tencv', 255);
            // $table->foreign('idcv')->references('idcv')->on('thanhvien');
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
        Schema::dropIfExists('chucvu');
    }
};
