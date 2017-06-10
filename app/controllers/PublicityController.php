<?php

class PublicityController extends BaseController {
	public $slide_rules = array(
		'title' => 'sometimes|min:4|max:100',
		'url'   => 'sometimes|url',
	);
	public $slide_attr = array(
		'title' => 'titulo',
		'url'   => 'URL',
	);
	public function saveSlide(&$slide, $data)
	{
		if (Input::has('title')) {
			$slide->title = $data['title'];
		}
		if (Input::has('url')) {
			$slide->url   = $data['url'];
		}
		if (Input::has('show_title')) {
			$slide->show_title = 1;
		}else
		{
			$slide->show_title = 0;
		}
		if (Input::hasFile('image')) {
			$file = Input::file('image');
			$slide->image     = ImageController::upload_image($file,$file->getClientOriginalName(),'images/slides/');
		}
	}
	public function getNewSlide()
	{
		$title = "Nuevo Slide | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";

		return View::make('admin.publicity.new')
		->with('title',$title);
	}
	public function postNewSlide()
	{
		$data  = Input::all();
		$rules = array_merge($this->slide_rules,array('image' => 'required|image|max:3000'));
		$msg  = array();
		$attr = array_merge($this->slide_attr,array('image' => 'slide'));
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$slide = new Slide;
		$this->saveSlide($slide, $data);
		$slide->save();

		Session::flash('success','Se ha cargado el slide satisfactoriamente.');
		return Redirect::to('administracion/ver-slides');
	}
	public function getSlides()
	{
		$title = "Ver Slides | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";

		$slides = Slide::get();
		return View::make('admin.publicity.showSlides')
		->with('title',$title)
		->with('slides',$slides);
	}
	public function getMdfSlide($id)
	{
		$title = "Modificar Slide | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		$slide = Slide::find($id);
		return View::make('admin.publicity.mdfSlide')
		->with('title',$title)
		->with('slide',$slide);
	}
	public function postMdfSlide($id)
	{
		$data  = Input::all();
		$rules = array_merge($this->slide_rules,array('image' => 'sometimes|image|max:3000'));
		$msg  = array();
		$attr = array_merge($this->slide_attr,array('image' => 'slide'));
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$slide = Slide::find($id);
		$this->saveSlide($slide, $data);
		$slide->save();

		Session::flash('success','Se ha cargado el slide satisfactoriamente.');
		return Redirect::back();
	}
	public function postElimSlide()
	{
		$data  = Input::all();
		$rules = array('id' => 'required|exists:slides,id');
		$msg   = array();
		$attr  = array('id' => 'id del slide'); 
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Response::json(array(
				'type' => 'danger',
				'msg'  => $validator->getMessageBag()
			));
		}
		$id = Input::get('id');
		Slide::find($id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha eliminado el slide satisfactoriamente.'
		));
	}
	public function getPublicity()
	{
		$title = "Administrar Publicidad | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";

		return View::make('admin.publicity.publicity')
		->with('title',$title);	
	}

	public function postPublicity()
	{
		Validator::extend('min_date', function($attribute, $value, $parameters)
		{
		    return strtotime($value) >= time();
		});
		$data  = Input::all();
		$rules = array(
			'title' 		=> 'sometimes|min:4|max:100',
			'url'			=> 'sometimes|min:4|max:100|url',
			'image' 		=> 'required|image|max:3000',
			'start_date'	=> 'sometimes|date|min_date',
			'end_date'		=> 'sometimes|date|min_date',
		);
		$msg  = array(
			'min_date' => 'La :attribute debe ser mayor al dia de hoy',
		);
		$attr = array(
			'title' 		=> 'titulo',
			'image'			=> 'imagen',
			'start_date'    => 'fecha de inicio',
			'end_date'		=> 'fecha de fin',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$publicity 				= new Publicity;
		$publicity->ubication 	= $data['ubication'];
		if (Input::has('title')) {
			$publicity->title 	  	= $data['title'];
		}
		if (Input::has('url')) {
			$publicity->url 		= $data['url'];
		}
		if (Input::has('start_date')) {
			$publicity->start_date 	= date('Y-m-d',strtotime($data['start_date']));
			if (Input::has('end_date')) {
				$publicity->end_date 	= date('Y-m-d',strtotime($data['end_date']));
			}else
			{
				$publicity->end_date 	= date('Y-m-d',strtotime($data['start_date'])+2678500);
			}
		}else
		{
			$publicity->start_date 	= date('Y-m-d',time()+86400);
			if (Input::has('end_date')) {
				$publicity->end_date 	= date('Y-m-d',strtotime($data['end_date']));
			}else
			{
				$publicity->end_date 	= date('Y-m-d',time()+2678500);
			}
		}
		$file = Input::file('image');
		$publicity->image = ImageController::upload_image($file,$file->getClientOriginalName(),'images/publicity/');
		$publicity->save();
		Session::flash('success','Se ha agregado la publicidad satisfactoriamente.');
		return Redirect::to('administracion/ver-publicidades');
	}
	public function getPublicities()
	{
		$publicities = Publicity::with('location')->get();
		$title = "Ver Publicidades | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		return View::make('admin.publicity.showPublicity')
		->with('title',$title)
		->with('publicities',$publicities);
	}
	public function getMdfPublicity($id)
	{
		$title = "Modificar Publicidades | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		$p = Publicity::find($id); 
		return View::make('admin.publicity.mdfPublicity')
		->with('title',$title)
		->with('p',$p);
	}
	public function postMdfPub($id)
	{
		Validator::extend('min_date', function($attribute, $value, $parameters)
		{
		    return strtotime($value) >= time();
		});
		$data  = Input::all();
		$rules = array(
			'title' 		=> 'sometimes|min:4|max:100',
			'url'			=> 'sometimes|min:4|max:100|url',
			'image' 		=> 'sometimes|image|max:3000',
			'start_date'	=> 'sometimes|date|min_date',
			'end_date'		=> 'sometimes|date|min_date',
		);
		$msg  = array(
			'min_date' => 'La :attribute debe ser mayor al dia de hoy',
		);
		$attr = array(
			'title' 		=> 'titulo',
			'image'			=> 'imagen',
			'start_date'    => 'fecha de inicio',
			'end_date'		=> 'fecha de fin',
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$publicity 				= Publicity::find($id);
		$publicity->ubication 	= $data['ubication'];
		if (Input::has('title')) {
			$publicity->title 	  	= $data['title'];
		}
		if (Input::has('url')) {
			$publicity->url 		= $data['url'];
		}
		if (Input::has('start_date')) {
			$publicity->start_date 	= date('Y-m-d',strtotime($data['start_date']));
			if (Input::has('end_date')) {
				$publicity->end_date 	= date('Y-m-d',strtotime($data['end_date']));
			}else
			{
				$publicity->end_date 	= date('Y-m-d',strtotime($data['start_date'])+2678500);
			}
		}else
		{
			$publicity->start_date 	= date('Y-m-d',time()+86400);
			if (Input::has('end_date')) {
				$publicity->end_date 	= date('Y-m-d',strtotime($data['end_date']));
			}else
			{
				$publicity->end_date 	= date('Y-m-d',time()+2678500);
			}
		}
		if (Input::hasFile('image')) {
			$file = Input::file('image');
			$publicity->image = ImageController::upload_image($file,$file->getClientOriginalName(),'images/publicity/');
		}
		$publicity->save();
		Session::flash('success','Se ha modificado la publicidad satisfactoriamente.');
		return Redirect::back();
	}
	public function postPublicityElim()
	{
		$data  = Input::all();
		$rules = array('id' => 'required|exists:publicities,id');
		$msg   = array();
		$attr  = array('id' => 'id de la publicidad'); 
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Response::json(array(
				'type' => 'danger',
				'msg'  => $validator->getMessageBag()
			));
		}
		$id = Input::get('id');
		Publicity::find($id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha eliminado la publicidad satisfactoriamente.'
		));
	}
}