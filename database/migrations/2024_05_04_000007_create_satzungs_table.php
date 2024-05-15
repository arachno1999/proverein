<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatzungsTable extends Migration
{
    public function up()
    {
        Schema::create('satzungs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('paragraph');
            $table->string('titel');
            $table->longText('inhalt')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
