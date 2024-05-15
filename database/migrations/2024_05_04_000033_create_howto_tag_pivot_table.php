<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHowtoTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('howto_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('howto_id');
            $table->foreign('howto_id', 'howto_id_fk_9690911')->references('id')->on('howtos')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_9690911')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
