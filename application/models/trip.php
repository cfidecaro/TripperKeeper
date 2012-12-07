<?php

class Trip extends Eloquent {

	public static $timestamps = true;

	public function stops()
	{
		return $this->has_many('stop');
	}

}
