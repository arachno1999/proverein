<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMitgliedsTypsTable extends Migration
{
    public function up()
    {
        Schema::table('mitglieds_typs', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9663081')->references('id')->on('teams');
        });
    }
}
