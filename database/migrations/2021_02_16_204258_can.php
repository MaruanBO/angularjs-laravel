<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Can extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('can', function (Blueprint $table) {
            $date = date_default_timezone_get();
            $table->increments('id',true);
            $table->string('nombre_lata', 500);
            $table->string('color_principal', 100);
            $table->string('nacionalidad',200);
            $table->string('when_user',200);
            $table->date($date);
        });

        Schema::table('can', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('can');
    }
}
