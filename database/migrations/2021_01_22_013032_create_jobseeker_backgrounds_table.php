<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobseekerBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobseeker_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // $table->string('kids');
            $table->string('job');
            $table->string('employment_type');
            $table->string('frequency');                    //how long or often you get to work 1 day/everyday
            // $table->string('source_of_income');

            $table->string('daily_income');
            $table->string('daily_expenses');
            // $table->string('expenses');                  //what are their (daily) expenses ?

            $table->string('housing');
            $table->string('meals_day');
            $table->string('access_water');
            $table->string('access_electricity');
            $table->string('clothes');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobseeker_backgrounds');
    }
}
