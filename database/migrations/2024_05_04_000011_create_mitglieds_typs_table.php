<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitgliedsTypsTable extends Migration
{
    public function up()
    {
        Schema::create('mitglieds_typs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bezeichnung');
            $table->decimal('jahresbeitrag', 15, 2);
            $table->longText('beschreibung');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
