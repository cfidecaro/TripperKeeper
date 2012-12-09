<?php

class Add_Post_Tables {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->text('text');
			$table->decimal('lat', 11, 8);
			$table->decimal('lng', 11, 8);
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->on_delete('cascade');
		});

		Schema::create('media', function($table)
		{
			$table->increments('id');
			$table->integer('post_id')->unsigned();
			$table->string('file_id');
			$table->timestamps();

			$table->foreign('post_id')->references('id')->on('posts')->on_delete('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
		Schema::drop('media');
	}

}