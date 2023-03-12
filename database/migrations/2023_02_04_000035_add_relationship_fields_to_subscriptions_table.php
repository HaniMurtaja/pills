<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_subs_id')->nullable();
            $table->foreign('user_subs_id', 'user_subs_fk_7975226')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
