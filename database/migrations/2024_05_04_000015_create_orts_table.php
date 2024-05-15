<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrtsTable extends Migration
{
    public function up()
    {
        Schema::create('orts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->longText('beschreibung');
            $table->string('maps')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
