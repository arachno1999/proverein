<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVeranstaltungsTable extends Migration
{
    public function up()
    {
        Schema::table('veranstaltungs', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9663070')->references('id')->on('teams');
        });
    }
}
