<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagWebmenuPivotTable extends Migration
{
    public function up()
    {
        Schema::create('tag_webmenu', function (Blueprint $table) {
            $table->unsignedBigInteger('webmenu_id');
            $table->foreign('webmenu_id', 'webmenu_id_fk_9685493')->references('id')->on('webmenus')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_9685493')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
