<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFinanzensTable extends Migration
{
    public function up()
    {
        Schema::table('finanzens', function (Blueprint $table) {
            $table->unsignedBigInteger('kategorie_id')->nullable();
            $table->foreign('kategorie_id', 'kategorie_fk_9663073')->references('id')->on('finanzkategoriens');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9663054')->references('id')->on('teams');
        });
    }
}
