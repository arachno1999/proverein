<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitgliedTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('mitglied_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('mitglied_id');
            $table->foreign('mitglied_id', 'mitglied_id_fk_9665690')->references('id')->on('mitglieds')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_9665690')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
