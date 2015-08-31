<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::create('usuarios', function($tabla)
        {
            $tabla->increments('id');
            $tabla->string('username', 50);
            $tabla->string('email', 100)->unique();
            $tabla->string('password', 200);
            $tabla->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }

}
