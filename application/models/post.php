<?php

class Post extends Eloquent {

	public static $timestamps = true;

	public function media()
	{
		return $this->has_many('media');
	}

}
