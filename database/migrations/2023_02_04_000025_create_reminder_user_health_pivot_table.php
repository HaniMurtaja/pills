<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReminderUserHealthPivotTable extends Migration
{
    public function up()
    {
        Schema::create('reminder_user_health', function (Blueprint $table) {
            $table->unsignedBigInteger('reminder_id');
            $table->foreign('reminder_id', 'reminder_id_fk_7975219')->references('id')->on('reminders')->onDelete('cascade');
            $table->unsignedBigInteger('user_health_id');
            $table->foreign('user_health_id', 'user_health_id_fk_7975219')->references('id')->on('user_healths')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reminder_user_health');
    }
}
