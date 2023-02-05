<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUserHealthPivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_user_health', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_7975206')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_health_id');
            $table->foreign('user_health_id', 'user_health_id_fk_7975206')->references('id')->on('user_healths')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_user_health');
    }
}
