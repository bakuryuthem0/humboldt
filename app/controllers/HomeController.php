<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		$title  		= "Inicio | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		$slides 		= Slide::get(); 
		$categories		= Categoria::get();
		$operations		= Operation::get();
		$publications   = Publication::with('images')
		->with('misc')
		->with('operation')
		->take(12)
		->get();
		$populars = Contact::with(array('publication' => function($publication){
			$publication
			->with('images')
			->with('misc');
		}))
		->groupBy('publication_id')
		->orderBy('top_val','DESC')
		->take(4)
		->selectRaw('publication_id, count(publication_id) as top_val')
		->get();
		$publicity = Publicity::where('ubication','=',1)->get();
		return View::make('index.index')
		->with('title',$title)
		->with('slides',$slides)
		->with('categories',$categories)
		->with('operations',$operations)
		->with('publications',$publications)
		->with('populars',$populars)
		->with('publicity',$publicity)
		->with('home','home');
	}
	public function getAbout()
	{
		$title = "Acerca de Nosotros | Inversora Humboldt";

		return View::make('about.index')
		->with('title',$title);
	}
	public function getQuestions()
	{
		$questions = Question::get();

		$title = "Preguntas Frecuentes | Inversora Humboldt";
		return View::make('about.questions')
		->with('title',$title)
		->with('questions',$questions);
	}
	public function getPolicy()
	{
		$title = "Politicas de Privacidad | Inversora Humboldt";
		return View::make('about.policy')
		->with('title',$title);
	}
}
