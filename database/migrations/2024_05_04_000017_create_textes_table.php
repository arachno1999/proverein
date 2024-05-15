<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextesTable extends Migration
{
    public function up()
    {
        Schema::create('textes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->string('titel')->nullable();
            $table->longText('offiziell')->nullable();
            $table->longText('persoenlich')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
