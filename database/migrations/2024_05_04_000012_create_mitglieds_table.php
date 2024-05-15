<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitgliedsTable extends Migration
{
    public function up()
    {
        Schema::create('mitglieds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('birthday');
            $table->string('anrede');
            $table->string('email')->nullable();
            $table->date('eintritt');
            $table->date('austritt')->nullable();
            $table->string('phone')->nullable();
            $table->longText('anschrift')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
