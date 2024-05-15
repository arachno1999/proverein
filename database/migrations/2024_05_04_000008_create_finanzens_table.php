<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanzensTable extends Migration
{
    public function up()
    {
        Schema::create('finanzens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('datum');
            $table->string('bezeichnung');
            $table->decimal('betrag', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
