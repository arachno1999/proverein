<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitgliedOrganePivotTable extends Migration
{
    public function up()
    {
        Schema::create('mitglied_organe', function (Blueprint $table) {
            $table->unsignedBigInteger('mitglied_id');
            $table->foreign('mitglied_id', 'mitglied_id_fk_9663225')->references('id')->on('mitglieds')->onDelete('cascade');
            $table->unsignedBigInteger('organe_id');
            $table->foreign('organe_id', 'organe_id_fk_9663225')->references('id')->on('organes')->onDelete('cascade');
        });
    }
}
