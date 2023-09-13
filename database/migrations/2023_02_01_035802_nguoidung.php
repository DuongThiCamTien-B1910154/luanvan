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
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->bigIncrements('idnd');
            $table->string('tennd', 255);
            $table->string('sdt', 255);
            $table->string('diachi', 255);
            $table->string('gtinh', 255);
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
    }
};
