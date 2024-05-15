<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMitgliedsTable extends Migration
{
    public function up()
    {
        Schema::table('mitglieds', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_9663094')->references('id')->on('mitglieds_typs');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9663104')->references('id')->on('teams');
        });
    }
}
