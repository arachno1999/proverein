<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganesTable extends Migration
{
    public function up()
    {
        Schema::create('organes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung')->unique();
            $table->integer('reihenfolge');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
