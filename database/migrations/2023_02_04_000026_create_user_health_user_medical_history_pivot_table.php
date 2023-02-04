<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHealthUserMedicalHistoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_health_user_medical_history', function (Blueprint $table) {
            $table->unsignedBigInteger('user_medical_history_id');
            $table->foreign('user_medical_history_id', 'user_medical_history_id_fk_7975225')->references('id')->on('user_medical_histories')->onDelete('cascade');
            $table->unsignedBigInteger('user_health_id');
            $table->foreign('user_health_id', 'user_health_id_fk_7975225')->references('id')->on('user_healths')->onDelete('cascade');
        });
    }
}
