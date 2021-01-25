<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobseekerDependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobseeker_dependents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jobseeker_backgrounds_id');
            $table->string('relation');
            $table->string('name');
            $table->string('age');
            $table->string('sex');
            $table->timestamps();

            $table->foreign('jobseeker_backgrounds_id')->references('id')->on('jobseeker_backgrounds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobseeker_dependents');
    }
}
