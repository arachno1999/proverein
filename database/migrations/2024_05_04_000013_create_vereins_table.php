<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVereinsTable extends Migration
{
    public function up()
    {
        Schema::create('vereins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('beschreibung');
            $table->date('gruendung');
            $table->string('register');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
