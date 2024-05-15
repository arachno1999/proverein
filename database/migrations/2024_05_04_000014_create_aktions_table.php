<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktionsTable extends Migration
{
    public function up()
    {
        Schema::create('aktions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->longText('beschreibung');
            $table->datetime('start')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
