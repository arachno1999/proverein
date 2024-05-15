<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmenusTable extends Migration
{
    public function up()
    {
        Schema::create('submenus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->integer('reihenfolge');
            $table->longText('beschreibung')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
