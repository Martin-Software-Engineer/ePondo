<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFourPsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('four_ps_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobseeker_id');
            $table->string('acquirement_process');
            $table->string('performance_of_service');
            $table->string('benefits');
            $table->timestamps();

            $table->foreign('jobseeker_id')->references('id')->on('jobseeker_backgrounds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('four_ps_data');
    }
}
