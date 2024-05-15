<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAktionsTable extends Migration
{
    public function up()
    {
        Schema::table('aktions', function (Blueprint $table) {
            $table->unsignedBigInteger('text_id')->nullable();
            $table->foreign('text_id', 'text_fk_9665716')->references('id')->on('textes');
            $table->unsignedBigInteger('ort_id')->nullable();
            $table->foreign('ort_id', 'ort_fk_9663224')->references('id')->on('orts');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9663214')->references('id')->on('teams');
        });
    }
}
