<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagVereinPivotTable extends Migration
{
    public function up()
    {
        Schema::create('tag_verein', function (Blueprint $table) {
            $table->unsignedBigInteger('verein_id');
            $table->foreign('verein_id', 'verein_id_fk_9665689')->references('id')->on('vereins')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_9665689')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
