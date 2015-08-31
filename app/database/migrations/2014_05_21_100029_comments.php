<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::create('comments', function($tabla)
        {
            // id auto incremental primary key
            $tabla->increments('id');
            $tabla->integer('user_id')->unsigned();
            $tabla->integer('post_id')->unsigned();
            $tabla->text('comment');
            $tabla->timestamps();
            $tabla->foreign("user_id")->references("id")->on("usuarios")->onDelete("cascade");
            $tabla->foreign("post_id")->references("id")->on("posts")->onDelete("cascade");
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }

}
