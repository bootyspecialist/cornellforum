<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		Schema::create('threads', function(Blueprint $table) {
		    $table->increments('id');
		    $table->string('title');
			$table->text('body_raw');
			$table->text('body');
			$table->string('slug');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('points')->unsigned()->default(1);
			$table->smallInteger('sticky')->default(0);
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
		 Schema::drop('threads');
	}

}
