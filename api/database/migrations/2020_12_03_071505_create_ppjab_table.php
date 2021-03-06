<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpjabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppjab', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('provinsi_id')->unsigned();
            $table->bigInteger('kab_kota_id')->unsigned();
            $table->text('kecamatan');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppjab');
    }
}
