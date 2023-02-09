<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name',100)->unique();
            $table->string('email',100)->unique();
            $table->date('birtday')->nullable();
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('password',191);
            $table->string('reset_password');
            $table->integer('status');
            $table->tinyInteger('flag_delete')->tinyint(1)->default(0);
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
        //
    }
};
