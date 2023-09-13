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
        Schema::create('ghe', function (Blueprint $table) {
            $table->bigIncrements('idghe');
            $table->string('tinhtrang', 255);
            $table->unsignedBigInteger('idxe');
            $table->foreign('idxe')->references('idxe')->on('xe');
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
        Schema::dropIfExists('ghe');

    }
};
