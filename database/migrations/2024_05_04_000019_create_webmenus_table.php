<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebmenusTable extends Migration
{
    public function up()
    {
        Schema::create('webmenus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->integer('reihenfolge');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
