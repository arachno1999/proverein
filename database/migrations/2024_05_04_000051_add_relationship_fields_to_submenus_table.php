<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubmenusTable extends Migration
{
    public function up()
    {
        Schema::table('submenus', function (Blueprint $table) {
            $table->unsignedBigInteger('webmenu_id')->nullable();
            $table->foreign('webmenu_id', 'webmenu_fk_9687820')->references('id')->on('webmenus');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9687827')->references('id')->on('teams');
        });
    }
}
