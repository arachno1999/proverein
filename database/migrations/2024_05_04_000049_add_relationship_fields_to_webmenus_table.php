<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWebmenusTable extends Migration
{
    public function up()
    {
        Schema::table('webmenus', function (Blueprint $table) {
            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('template_id', 'template_fk_9685494')->references('id')->on('templates');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9685498')->references('id')->on('teams');
        });
    }
}
