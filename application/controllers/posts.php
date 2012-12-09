<?php

class Posts_Controller extends Base_Controller {

	public function action_add_post()
	{
		$text     = Input::get('post-text');
		$location = json_decode(Input::get('post-location'));
		$file_id  = Auth::user()->id . '-' . time();

		Input::upload('post-media', path('storage') . '/media', $file_id);

		$post = new Post();
		$post->user_id = Auth::user()->id;
		$post->text    = $text;
		$post->lat     = $location->lat;
		$post->lng     = $location->lng;
		$post->save();

		$media = new Media();
		$media->file_id = $file_id;
		$post->media()->insert($media);

		echo $post->id;
	}

}
