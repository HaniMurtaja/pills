<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMedicalHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('user_medical_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('disease_name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
