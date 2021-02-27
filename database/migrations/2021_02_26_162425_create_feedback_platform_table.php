<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackPlatformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_platforms', function (Blueprint $table) {
            $table->id();
            $table->string('rating', 64);
            $table->text('message');
            $table->foreignId('service_id')->constrained('services');
            $table->set('from', ['jobseeker', 'backer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback_platform');
    }
}
