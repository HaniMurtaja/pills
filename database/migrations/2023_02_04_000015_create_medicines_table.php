<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('med_generic_name');
            $table->string('med_scientific_name');
            $table->string('med_quantity')->nullable();
            $table->date('med_expire_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
