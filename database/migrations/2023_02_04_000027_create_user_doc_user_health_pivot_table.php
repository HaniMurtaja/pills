<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDocUserHealthPivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_doc_user_health', function (Blueprint $table) {
            $table->unsignedBigInteger('user_doc_id');
            $table->foreign('user_doc_id', 'user_doc_id_fk_7975204')->references('id')->on('user_docs')->onDelete('cascade');
            $table->unsignedBigInteger('user_health_id');
            $table->foreign('user_health_id', 'user_health_id_fk_7975204')->references('id')->on('user_healths')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_doc_user_health');
    }
}
