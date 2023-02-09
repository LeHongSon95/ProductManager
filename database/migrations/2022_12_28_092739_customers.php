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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('phone',11)->unique();
            $table->string('email',100)->unique();
            $table->date('birtday')->nullable();
            $table->string('full_name',100);
            $table->string('address',255);
            $table->string('password',191);
            $table->string('reset_password');
            $table->integer('status');
            $table->unsignedBigInteger('province_id')->default(1);
            $table->unsignedBigInteger('district_id')->default(1);
            $table->unsignedBigInteger('commune_id')->default(1);
            $table->foreign('province_id')->references('id')->on('province');
            $table->foreign('district_id')->references('id')->on('district');
            $table->foreign('commune_id')->references('id')->on('commune');
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
