<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserMedicalHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('user_medical_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_history_id')->nullable();
            $table->foreign('user_history_id', 'user_history_fk_7975224')->references('id')->on('users');
        });
    }
}
