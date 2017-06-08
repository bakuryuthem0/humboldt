<?php

class AuthController extends BaseController {
	public function validateAndAttempt($data, $rules, $msg, $attr)
	{
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return $validator;
		}
		return true;
	}
	public function getAdminLogin()
	{
		$title = "Inicio de Sesión | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		return View::make('auth.adminLogin')
		->with('title',$title);
	}
	public function postAdminLogin()
	{
		$data = Input::all();
		$data = array(
			'email'		=> Input::get('username'),
			'password'	=> Input::get('password'),
		);
		$rules = array(
			'email'	   => 'required|exists:users,email,role_id,1',
			'password' => 'required|max:16'
		);
		$msg = array();
		$attr = array(
			'password' => 'contraseña'
		);
		$validation = $this->validateAndAttempt($data, $rules, $msg, $attr);
		if($validation){
			if (Auth::attempt($data)) {
				return Response::json(array('type' => 'success','msg' => 'Se ha iniciado sesión satisfactoriamente. Espere mientra lo redireccionamos.'));
			}
			return Response::json(array('type' => 'danger','msg' => 'Error al tratar de iniciar sesión, usuario o contraseña incorrectos.'));
		}
		return Response::json(array('type' => 'danger','msg' => $validation->getMessageBag));
	}
	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
}