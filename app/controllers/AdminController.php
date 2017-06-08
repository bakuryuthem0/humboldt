<?php

class AdminController extends BaseController {
	public function getIndex()
	{
		$title = "Administración | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		return View::make('admin.index')
		->with('title',$title);
	}
	public function getNewUser()
	{
		$title = "Crear nuevo usuario | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		return View::make('admin.user.new')
		->with('title',$title);
	}
	public function postNewUser()
	{
		$data  = Input::all();
		$rules = array(
			'username' 				=> 'required|min:5|unique:users,email',
			'password'  			=> 'required|min:6|max:16|confirmed',
			'password_confirmation' => 'required',
		);
		$msg = array();
		$attr = array(
			'password' 				=> 'contraseña',
			'password_confirmation' => 'confirmación de la contraseña',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$user = new User;
		$user->email    = $data['username'];
		$user->password = Hash::make($data['password']);
		$user->role_id  = 1;
		if ($user->save()) {
			Session::flash('success','Se ha creado el usuario satisfactoriamente.');
			return Redirect::back();
		}
 	}
 	public function getUsers()
 	{
 		$title = "Ver Usuarios | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
 		$users = User::with('roles')
 		->where('id','!=',Auth::id())
 		->orderBy('id','DESC')
 		->get();
 		return View::make('admin.user.show')
 		->with('title',$title)
 		->with('users',$users);
 	}
 	public function poastChangePass()
 	{
 		$data = Input::all();
 		$rules = array(
 			'user_id'  => 'required|exists:users,id',
 			'password' => 'required|min:8|max:16|confirmed',
			'password_confirmation' => 'required',
 		);
 		$validator = Validator::make($data, $rules);
 		if ($validator->fails()) {
 			return Response::json(array(
 				'type' => 'danger',
 				'data' => $validator->getMessageBag()->toArray()
 			));
 		}
 		$id = Input::get('user_id');
 		$user = User::find($id);
 		$user->password = Hash::make($data['password']);
 		$user->save();
 		return Response::json(array(
 			'type' => 'success',
 			'msg'  => 'Se ha cambiado la contraseña satisfactoriamente.'
 		));
 	}
 	public function postUserElim()
 	{
 		$data = Input::all();
 		$rules = array(
 			'user_id'  => 'required|exists:users,id',
 		);
 		$validator = Validator::make($data, $rules);
 		if ($validator->fails()) {
 			return Response::json(array(
 				'type' => 'danger',
 				'msg' => $validator->getMessageBag()->toArray()
 			));
 		}
 		$id = $data['user_id'];
 		$user = User::find($id);
 		if (count($user) < 1) {
 			return Response::json(array(
 				'type' => 'danger',
 				'msg'  => 'Error, el usuario ya fue borrado.',
 			));
 		}
 		if ($user->avatar != "avatar5.png") {
 			File::delete('images/avatars/'.$user->avatar);
 		}
 		$user->delete();
 		return Response::json(array(
 			'type' => 'success',
 			'msg'  => 'El usuario se ha eliminado satisfactoriamente.'
 		));
 	}
 	public function getNewCat()
 	{
 		$title = "Nueva Categoría | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
 		return View::make('admin.cat.new')
 		->with('title',$title);
 	}
 	public function postNewCat()
	{
		$data  = Input::all();
 		$rules = array(
 			'name'  => 'required|min:4|max:50',
 		);
 		$msg   = array();
 		$attr  = array(
 			'name' => 'nombre de la categoría',
 		);
 		$validator = Validator::make($data, $rules, $msg, $attr);
 		if ($validator->fails()) {
 			return Redirect::back()->withErrors($validator)->withInput();
 		}
		$cat = new Categoria;
		$cat->description  = $data['name'];
		if ($cat->save()) {
			Session::flash('success','Se ha creado la categoría satisfactoriamente.');
			return Redirect::back();
		}else
		{
			Session::flash('danger','Debe introducir un nombre');
			return Redirect::back();
		}
	}
	public function getCats()
	{
		$title = "Ver categorías | nombredelapagina";
		$cat = Categoria::orderBy('id','DESC')
		->get();
		return View::make('admin.cat.show')
		->with('title',$title)
		->with('cat',$cat);
	}
	public function getCat($id)
	{
		$cat = Categoria::find($id);
		$title = "Modificar categoría: ".$cat->description_es.' | nombredelapagina';
		return View::make('admin.cat.self')
		->with('cat',$cat)
		->with('title',$title);
	}
	public function postMdfCat($id)
	{
		$data  = Input::all();
 		$rules = array(
 			'name'  => 'required|min:4|max:50',
 		);
 		$msg   = array();
 		$attr  = array(
 			'name' => 'nombre de la categoría',
 		);
 		$validator = Validator::make($data, $rules, $msg, $attr);
 		if ($validator->fails()) {
 			return Redirect::back()->withErrors($validator)->withInput();
 		}
		$cat   = Categoria::find($id);
		$cat = Categoria::find($id);
		$cat->description = $data['name'];
		if ($cat->save()) {
			Session::flash('success','Se ha modificado la categoría satisfactoriamente.');
			return Redirect::back();
		}else
		{
			Session::flash('danger','Debe introducir un nombre');
			return Redirect::back();
		}
	}
	public function postElimCat()
	{
		$data  = Input::all();
 		$rules = array(
 			'cat_id'  => 'required|exists:categorias,id',
 		);
 		$validator = Validator::make($data, $rules);
 		if ($validator->fails()) {
 			return Response::json(array(
 				'type' => 'danger',
 				'msg' => $validator->getMessageBag()->toArray()
 			));
 		}
		$id  = Input::get('cat_id');
		$cat = Categoria::find($id)->delete();
		return Response::json(array('type' => 'success','msg' => 'Se ha eliminado la categoría satisfactoriamente.'));
		
	}
	public function getNewFrequentQuestion()
	{
		$title = "Nueva Pregunta Frecuente | Inversora Humboldt";

		return View::make('admin.questions.new')
		->with('title',$title);
	}
	public function postNewFrequentQuestion()
	{
		$data = Input::all();

		$rules = array(
			'title' 		=> 'required|min:4|max:100',
			'description'	=> 'required',
		);
		$msg = array();
		$attr = array(
			'title' 		=> 'titulo',
			'description'	=> 'descripción'
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$questions = new Question;
		$questions->title 		= $data['title'];
		$questions->description = $data['description'];
		$questions->save();
		Session::flash('success','Se ha creado la pregunta frecuente satisfactoriamente.');
		return Redirect::to('administracion/ver-preguntas-frecuentes'); 
	}
	public function getQuestions()
	{
		$questions = Question::get();
		$title = "Ver Preguntas Frecuentes | Inversora Humboldt";
		return View::make('admin.questions.show')
		->with('title',$title)
		->with('questions',$questions);
	}
	public function getMdfQuestion($id)
	{
		$question = Question::find($id);

		$title = "Modificar pregunta frecuente | Inversora Humboldt";
		return View::make('admin.questions.mdf')
		->with('title',$title)
		->with('question',$question);
	}
	public function postMdfQuestion($id)
	{
		$data = Input::all();

		$rules = array(
			'title' 		=> 'required|min:4|max:100',
			'description'	=> 'required',
		);
		$msg = array();
		$attr = array(
			'title' 		=> 'titulo',
			'description'	=> 'descripción'
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$questions = Question::find($id);
		$questions->title 		= $data['title'];
		$questions->description = $data['description'];
		$questions->save();
		Session::flash('success','Se ha modificado la pregunta frecuente satisfactoriamente.');
		return Redirect::back(); 
	}
	public function postElimQuestion()
	{
		$data  = Input::all();
		$rules = array('id' => 'required|exists:questions,id');
		$msg   = array();
		$attr  = array('id' => 'id de la pregunta frecuente'); 
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Response::json(array(
				'type' => 'danger',
				'msg'  => $validator->getMessageBag()
			));
		}
		$id = Input::get('id');
		Question::find($id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha eliminado la pregunta frecuente satisfactoriamente.'
		));
	}
}