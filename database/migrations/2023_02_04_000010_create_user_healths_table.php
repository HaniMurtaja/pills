<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHealthsTable extends Migration
{
    public function up()
    {
        Schema::create('user_healths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('careby_id')->unique();
            $table->string('name');
            $table->string('gender');
            $table->date('dob');
            $table->string('blood_pressure');
            $table->string('blood_group');
            $table->float('height', 15, 2);
            $table->float('weight', 15, 2);
            $table->float('bmi', 15, 2);
            $table->string('total_cholestrol');
            $table->string('ldl_cholestrol');
            $table->string('hdl_cholestrol');
            $table->string('triglycerides');
            $table->string('glucose');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
