<?php

class Add_Order_Column_To_Stops {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('stops', function($table)
		{
			$table->integer('order');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stops', function($table)
		{
			$table->drop_column('order');
		});
	}

}