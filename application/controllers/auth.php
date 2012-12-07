<?php

class Auth_Controller extends OneAuth\Auth\Controller {

	public function action_register()
	{
		$user_data = Session::get('oneauth');
		$user = new User;

		$user->name = $user_data['info']['name'];
		$user->email = $user_data['info']['email'];
		$user->image_url = $user_data['info']['image'];
		$user->login_provider = $user_data['provider'];
		$user->login_uid = $user_data['info']['uid'];
		$user->save();

		Event::fire('oneauth.sync', array($user->id));

		Auth::login($user->id);

		return Redirect::to('/');
	}

	public function action_login()
	{
		echo 'login'; die();
	}

	public function action_logout()
	{
		Auth::logout();

		return Redirect::to('/');
	}

}
