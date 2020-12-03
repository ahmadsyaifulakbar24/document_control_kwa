<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentPpjabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_ppjab', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppjab_id')->constrained('ppjab')->onUpdate('cascade')->onUpdate('cascade');
            $table->foreignId('group_id')->constrained('params')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->text('keterangan');
            $table->string('file');
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
        Schema::dropIfExists('document_ppjab');
    }
}
