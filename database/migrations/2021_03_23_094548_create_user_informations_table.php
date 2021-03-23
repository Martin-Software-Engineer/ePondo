<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middleinitial', 4)->nullable();
            $table->string('bio')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthdate')->nullable();
            $table->integer('age')->nullable();
            $table->string('current_job')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('freq_of_work')->nullable();
            $table->string('main_source_income')->nullable();
            $table->string('extra_source_income')->nullable();
            $table->string('skills')->nullable();
            $table->string('work_exp')->nullable();
            $table->string('daily_income')->nullable();
            $table->string('daily_expenses')->nullable();
            $table->string('type_of_housing')->nullable();
            $table->string('daily_meals')->nullable();
            $table->string('water_access')->nullable();
            $table->string('electricity_access')->nullable();
            $table->string('clean_clothes_access')->nullable();
            $table->boolean('has_kids')->default(0);
            $table->boolean('has_dependents')->default(0);
            $table->boolean('has_4ps')->default(0);
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
        Schema::dropIfExists('user_informations');
    }
}
