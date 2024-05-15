<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktionOrganePivotTable extends Migration
{
    public function up()
    {
        Schema::create('aktion_organe', function (Blueprint $table) {
            $table->unsignedBigInteger('aktion_id');
            $table->foreign('aktion_id', 'aktion_id_fk_9663223')->references('id')->on('aktions')->onDelete('cascade');
            $table->unsignedBigInteger('organe_id');
            $table->foreign('organe_id', 'organe_id_fk_9663223')->references('id')->on('organes')->onDelete('cascade');
        });
    }
}
