<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
              
        // $table->unsignedBigInteger('role_id'); //foreign key to bind with the roles table
            // $table->foreign('role_id')->references('id')->on('roles'); //additional
            // $table->unsignedBigInteger('role_id');

            // $table->foreign('role_id')->references('id')->on('roles');
            // $table->foreignId('role_id')->constrained('roles');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        // Schema::table('role_user', function (Blueprint $table) {
        //     $table->dropForeign('role_user_role_id_foreign');
        //     $table->dropForeign('role_user_user_id_foreign');
        // });
        Schema::dropIfExists('role_user');
    }
}
