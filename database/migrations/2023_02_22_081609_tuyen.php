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
        Schema::create('tuyen', function (Blueprint $table) {
            $table->bigIncrements('idtuyen');
            $table->string('tentuyen', 255);
            $table->string('diemKH', 255);
            $table->string('diemKT', 255);
            $table->string('tg_dukien', 255);
            $table->string('tansuat', 255);
            $table->string('giave', 255);
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
        Schema::dropIfExists('tuyen');

    }
};
