<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_price')->nullable();
            $table->integer('payment_method');
            $table->longText('service_description')->nullable();
            $table->date('arriving_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
