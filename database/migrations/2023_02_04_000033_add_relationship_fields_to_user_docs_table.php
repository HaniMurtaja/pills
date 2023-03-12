<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserDocsTable extends Migration
{
    public function up()
    {
        Schema::table('user_docs', function (Blueprint $table) {
            $table->unsignedBigInteger('user_doc_id')->nullable();
            $table->foreign('user_doc_id', 'user_doc_fk_7975221')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_docs');
    }
}
