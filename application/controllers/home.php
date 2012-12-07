<?php

class Home_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function action_index()
	{
		Asset::add('google_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAjY1vSMlFplFq42d2VLTAOILxaQQMneLU&sensor=true');
		Asset::add('map', 'js/map.js', ['jquery', 'ajax', 'google_maps']);
		Asset::add('trip', 'js/trip.js', ['jquery', 'ajax', 'map']);

		if (Auth::check())
		{
			$oneauth_token = unserialize(Session::get('oneauth.token'));
			$image_url     = 'https://graph.facebook.com/me/picture?type=square&height=50&access_token=' . $oneauth_token->access_token;

			$existing_trips = [];

			foreach (Auth::user()->trips as $trip)
			{
				$existing_trips[] = [
					'label' => $trip->name,
					'url'   => '#trip-' . $trip->id,
					'attributes' => [
						'data-toggle' => 'modal'
					]
				];
			}

			if (count($existing_trips))
			{
				$existing_trips[] = '---';
			}

			$existing_trips[] = [
				'label'  => '+ New Trip',
				'url'    => '#new-trip',
				'attributes' => [
					'data-toggle' => 'modal'
				]
			];

			$menu = [
				[
					'items' => [
						[
							'label' => 'Trips',
							'url'   => '#',
							'items' => $existing_trips
						],
					]
				],

				[
					'attributes' => ['class' => 'pull-right'],
					'items'      => [
						[
							'label' => 'Logout',
							'url'   => URL::to('auth/logout')
						]
					]
				],

				'<p class="pull-right navbar-text">' . HTML::image($image_url, Auth::user()->name, ['style' => 'height: 25px']) . ' ' . Auth::user()->name . '</p>'
			];
		}

		else
		{
			$menu = [
				[
					'attributes' => ['class' => 'pull-right'],
					'items'      => [
						[
							'label' => 'Login with Facebook',
							'url'   => URL::to('auth/session/facebook')
						]
					]
				]
			];
		}

		$view = View::make('home.index');
		$view->menu = $menu;

		return $view;
	}

}