<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalGuidesTable extends Migration
{
    public function up()
    {
        Schema::create('medical_guides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('guide_name');
            $table->string('guide_category');
            $table->string('guide_phone');
            $table->string('guide_image');
            $table->string('guide_working_hours');
            $table->string('guide_status');
            $table->string('guide_address');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_guides');
    }
}
