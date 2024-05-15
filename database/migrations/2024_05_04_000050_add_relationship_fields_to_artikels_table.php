<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToArtikelsTable extends Migration
{
    public function up()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->foreign('menu_id', 'menu_fk_9685527')->references('id')->on('webmenus');
            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('template_id', 'template_fk_9685628')->references('id')->on('templates');
            $table->unsignedBigInteger('submenu_id')->nullable();
            $table->foreign('submenu_id', 'submenu_fk_9687828')->references('id')->on('submenus');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9685538')->references('id')->on('teams');
        });
    }
}
