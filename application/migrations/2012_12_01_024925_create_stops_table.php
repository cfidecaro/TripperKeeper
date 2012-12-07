<?php

class Create_Stops_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stops', function($table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('trip_id')->unsigned();
			$table->string('address');
			$table->decimal('lat', 11, 8);
			$table->decimal('lng', 11, 8);
			$table->timestamps();

			$table->foreign('trip_id')->references('id')->on('trips')->on_delete('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stops');
	}

}