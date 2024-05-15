<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHowtosTable extends Migration
{
    public function up()
    {
        Schema::create('howtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->longText('beschreibung');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
