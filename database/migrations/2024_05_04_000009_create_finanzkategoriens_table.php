<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanzkategoriensTable extends Migration
{
    public function up()
    {
        Schema::create('finanzkategoriens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
