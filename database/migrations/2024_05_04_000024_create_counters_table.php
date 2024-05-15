<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountersTable extends Migration
{
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->string('key');
            $table->integer('counter');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
