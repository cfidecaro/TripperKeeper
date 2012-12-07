<?php

class Trips_Controller extends Base_Controller {

	public function action_create()
	{
		$trip = new Trip;

		$trip->user_id = Auth::user()->id;
		$trip->name    = Input::get('name');

		$trip->save();

		return Response::json($trip->to_array());
	}

	public function action_update()
	{
		$trip = Trip::find(Input::get('trip-id'));

		$trip->name = Input::get('name');

		$trip->save();
	}

	public function action_add_stop($id)
	{
		$trip = Trip::find($id);

		$stop = new Stop;

		$stop->address = Input::get('address');
		$stop->lat     = Input::get('lat');
		$stop->lng     = Input::get('lng');
		$stop->order   = Input::get('order');

		$trip->stops()->insert($stop);

		return Response::json($stop->to_array());
	}

}
