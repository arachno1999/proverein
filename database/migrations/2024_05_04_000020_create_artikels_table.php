<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelsTable extends Migration
{
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->date('sichtbar');
            $table->date('end')->nullable();
            $table->longText('intro')->nullable();
            $table->longText('fulltext');
            $table->string('position');
            $table->integer('reihenfolge')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
