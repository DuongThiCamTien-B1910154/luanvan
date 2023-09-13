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
        Schema::create('xe', function (Blueprint $table) {
            $table->bigIncrements('idxe');
            $table->string('bienso', 255);
            $table->string('namsx', 255);
            $table->integer('giave');
            $table->unsignedBigInteger('idlx');
            $table->foreign('idlx')->references('idlx')->on('loaixe');
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
        Schema::dropIfExists('xe');

    }
};
