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
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('user_name',100);
            $table->date('birtday');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('password',191);
            $table->string('reset_password');
            $table->string('status',191);
            $table->tinyInteger('flag_delete');
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
        Schema::dropIfExists('posts');
    }
};
