<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineUserHealthPivotTable extends Migration
{
    public function up()
    {
        Schema::create('medicine_user_health', function (Blueprint $table) {
            $table->unsignedBigInteger('medicine_id');
            $table->foreign('medicine_id', 'medicine_id_fk_7975220')->references('id')->on('medicines')->onDelete('cascade');
            $table->unsignedBigInteger('user_health_id');
            $table->foreign('user_health_id', 'user_health_id_fk_7975220')->references('id')->on('user_healths')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('medicine_user_health');
    }

}
