<?php

class UserController extends BaseController {
	public function getProfile()
	{
		$title = "Perfil de usuario | nombredelapagina";
		return View::make('admin.user.profile')
		->with('title',$title);
	}
	public function postAdminProfile()
	{
		Session::flash('act','perfil');
		$data  = Input::all();
		$rules = array(
			'name'  	=> 'required',
			'lastname'  => 'required',
		);
		$msg = array();
		$cus = array(
			'name' 		=> 'nombre',
			'lastname'	=> 'apellido'
		);
		$validator = Validator::make($data, $rules, $msg, $cus);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$name  		= Input::get('name');
		$lastname 	= Input::get('lastname');
		$user  		= User::find(Auth::id());
		if ($name != Auth::user()->name) {
		 	$user->name = $name;
	 	} 
	 	if ($lastname != Auth::user()->lastname) {
		 	$user->lastname = $lastname;
	 	}
	 	if (Input::hasFile('avatar')) {
	 		$img = Input::file('avatar');
	 		$user->avatar = $this->upload_image($img,'images/avatars');
	 	}
	 	if ($user->save()) {
	 		Session::flash('success','Se actualizaron los datos satisfactoriamente.');
	 	 	return Redirect::back();
	 	 } 
	}
	public function postAdminPass()
	{
		Session::flash('act','pass');
		$data = Input::all();
		Validator::extend('checkCurrentPass', function($attribute, $value, $parameters)
		{
		    if( ! Hash::check( $value , $parameters[0] ) )
		    {
		        return false;
		    }
		    return true;
		});
		$rules = array(
			'password_old' 			=> 'required|checkCurrentPass:'.Auth::user()->password,
			'password'	   			=> 'required|max:16|confirmed',
			'password_confirmation' => 'required',
		);
		$msg = array();
		$attr = array(
			'password_old' 			=> 'contraseña actual',
			'password'	   			=> 'nueva contraseña',
			'password_confirmation' => 'confirmación de la contraseña'
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$user = User::find(Auth::id());
		$user->password = Hash::make($data['password']);
		$user->save();
		Session::flash('success','Se ha cambiado su contraseña satisfactoriamente.');
		return Redirect::back();
	}
}