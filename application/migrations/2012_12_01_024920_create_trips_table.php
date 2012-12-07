<?php

class Create_Trips_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trips', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('name');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->on_delete('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trips');
	}

}