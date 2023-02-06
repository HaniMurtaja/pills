<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration
{
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('applying');
            $table->integer('doses');
            $table->string('duration');
            $table->string('times');
            $table->string('start_from');
            $table->string('days_of_week');
            $table->string('snooze');
            $table->time('time');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reminders');
    }
}
