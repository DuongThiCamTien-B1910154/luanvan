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
        Schema::create('phieudatve', function (Blueprint $table) {
            $table->bigIncrements('idpdv');
            $table->string('ngaydi', 255);
            $table->timestamps();
            $table->integer('PTTT')->comment("0:COD, 1:Chuyển khoản");
            $table->string('tongtien');
            $table->unsignedBigInteger('idkh');
            $table->unsignedBigInteger('idvx');
            $table->foreign('idkh')->references('idkh')->on('khachhang');
            $table->foreign('idvx')->references('idvx')->on('vexe');
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
        Schema::dropIfExists('phieudatve');
    }
};
