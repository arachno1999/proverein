<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeranstaltungsTable extends Migration
{
    public function up()
    {
        Schema::create('veranstaltungs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->datetime('from');
            $table->datetime('to');
            $table->longText('beschreibung');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
