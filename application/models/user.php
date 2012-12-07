<?php

class User extends Eloquent {

	public static $timestamps = true;

	public function trips()
	{
		return $this->has_many('trip');
	}

}
