<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFinanzkategoriensTable extends Migration
{
    public function up()
    {
        Schema::table('finanzkategoriens', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9663061')->references('id')->on('teams');
        });
    }
}
