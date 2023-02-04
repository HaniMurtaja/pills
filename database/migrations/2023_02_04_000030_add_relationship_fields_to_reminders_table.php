<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRemindersTable extends Migration
{
    public function up()
    {
        Schema::table('reminders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_reminder_id')->nullable();
            $table->foreign('user_reminder_id', 'user_reminder_fk_7975208')->references('id')->on('users');
        });
    }
}
