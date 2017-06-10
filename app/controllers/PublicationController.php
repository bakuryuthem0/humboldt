<?php

class PublicationController extends BaseController {
	public function getPolulars()
	{
		return $populars = Contact::with(array('publication' => function($publication){
			$publication->with('images');
		}))
		->groupBy('publication_id')
		->orderBy('top_val','DESC')
		->take(4)
		->selectRaw('publication_id, count(publication_id) as top_val')
		->get();
	}
	public $publications_rules = array(
		'title'	    		=> 'required|min:4|max:100',
		'city'				=> 'required|exists:cities,id',
		'category'			=> 'required|exists:categorias,id',
		'operation'			=> 'required|exists:operations,id',
		'price'				=> 'required|numeric',
		'description'		=> 'required|max:3000',
		'rooms'				=> 'required|min:0|max:100',
		'bathrooms'			=> 'required|min:0|max:100',
		'parking_slots'		=> 'required|min:0|max:100',
		'size'				=> 'required|min:0|max:32621',
	);
	public $publications_attr = array(
		'title'				=> 'titulo',
		'city'				=> 'ciudad',
		'category'			=> 'categoría',
		'operation'			=> 'tipo de operación',
		'price'   			=> 'precio',
		'description'		=> 'descripción',
		'rooms'				=> 'cantidad de habitaciones',
		'bathrooms'			=> 'cantidad de baños',
		'parking_slots'		=> 'cantidad de puesto de estacionamiento',
		'size'				=> 'tamaño (m<sup>2</sup>)',
	);

	public function savePublicationmData(&$publication, $data)
	{
		$publication->publication_cod = $data['publication_cod'];
		$publication->title    		  = $data['title'];
		$publication->city_id    	  = $data['city'];
		$publication->category_id  	  = $data['category'];
		$publication->operation_id 	  = $data['operation'];
		$publication->price   	      = $data['price'];
		$publication->description 	  = $data['description'];
		
	}
	public static function savePublicationDetails($data, &$publication_misc)
	{
		$publication_misc->rooms 		 = $data['rooms'];
		$publication_misc->bathrooms 	 = $data['bathrooms'];
		$publication_misc->parking_slots = $data['parking_slots'];
		$publication_misc->size 		 = $data['size'];
		if (Input::has('map')) {
			$publication_misc->map 			 = $data['map'];
		}
	}
	public function searchFilters(&$publication, &$paginatorFilter, &$sideBar, &$view, $data)
	{
		if (Input::has('busq')) {
			$publication = $publication->where(function($query) use($data){
				$query->where('title','LIKE',$data['busq'].'%')
				->orWhere('title','LIKE','%'.$data['busq'].'%')
				->orWhere('title','LIKE','%'.$data['busq'])
				->orWhere('description','LIKE',$data['busq'].'%')
				->orWhere('description','LIKE','%'.$data['busq'].'%')
				->orWhere('description','LIKE','%'.$data['busq']);
			});
			$paginatorFilter .= '&busq='.$data['busq'];
			$sideBar = $sideBar->with('busq',$data['busq']);
			$view = $view->with('busq',$data['busq']);
		}
		if (Input::has('city') && Input::get('city') != "*") {
			$publication = $publication->where('city_id','=',$data['city']);
			$paginatorFilter .= '&city='.$data['city'];
			$sideBar = $sideBar->with('city',$data['city']);
		}
		if (Input::has('cat') && Input::get('cat') != "*") {
			$publication = $publication->where('category_id','=',$data['cat']);
			$paginatorFilter .= '&cat='.$data['cat'];
			$sideBar = $sideBar->with('cat',$data['cat']);
		}
		if (Input::has('operation') && Input::get('operation') != "*") {
			$publication = $publication->where('operation_id','=',$data['operation']);
			$paginatorFilter .= '&operation='.$data['operation'];
			$sideBar = $sideBar->with('operation',$data['operation']);
		}
		if (Input::has('min') || Input::has('max'))
		{
			if (Input::has('min') && Input::has('max') && !empty($data['min']) && !empty($data['max'])) {
				$minmax = array($data['min'], $data['max']);
				$paginatorFilter .= '&min='.$data['min'].'&max='.$data['max'];
				$publication =  $publication->where('price','>=',$data['min'])->where('price','<=',$data['max']);
				$sideBar = $sideBar->with('min',$data['min'])->with('max',$data['max']);
			}else{
				if(Input::has('max') && !empty($data['max'])){
					$paginatorFilter .= '&max='.$data['max'];
					$publication =  $publication->where('price','<=',$data['max']);
					$sideBar = $sideBar->with('max',$data['max']);

				}elseif(Input::has('min') && !empty($data['min'])){
					$paginatorFilter .= '&min='.$data['min'];
					$publication =  $publication->where('price','>=',$data['min']);
					$sideBar = $sideBar->with('min',$data['min']);
				}
			}
		}
		if (Input::has('rooms')) {
			$publication = $publication->whereHas('misc',function($rooms) use ($data){
				$rooms->where('rooms','=',$data['rooms']);
			});	
			$paginatorFilter .= '&rooms='.$data['rooms'];
			$sideBar = $sideBar->with('rooms',$data['rooms']);

		}
		if (Input::has('baths')) {
			$publication = $publication->whereHas('misc',function($baths) use ($data){
				$baths->where('bathroomss','=',$data['baths']);
			});
			$paginatorFilter .= '&baths='.$data['baths'];
			$sideBar = $sideBar->with('baths',$data['baths']);

		}
		if (Input::has('park')) {
			$publication = $publication->whereHas('misc',function($park) use ($data){
				$park->where('parking_slots','=',$data['park']);
			});
			$paginatorFilter .= '&park='.$data['park'];
			$sideBar = $sideBar->with('park',$data['park']);

		}
		if (Input::has('size')) {
			$publication = $publication->whereHas('misc',function($size) use ($data){
				$size->where('size','=',$data['size']);
			});
			$paginatorFilter .= '&size='.$data['size'];
			$sideBar = $sideBar->with('size',$data['size']);

		}
		if (Input::has('sort_by')) {
			$sort 	= Input::get('sort_by');
			switch ($sort) {
				case 'date':
					$sort_by   = 'id';
					$sort_type = 'DESC';
					break;
				case 'price_asc':
					$sort_by   = 'price';
					$sort_type = 'ASC';
				case 'price_desc':
					$sort_by   = 'price';
					$sort_type = 'DESC';
				default:
					$sort_by   = 'id';
					$sort_type = 'DESC';
					break;
			}
			$publication = $publication->orderBy($sort_by,$sort_type);
			$view = $view->with('sort_by',$sort);
			$paginatorFilter .= '&sort_by='.$sort_by;
		}
		if(Input::has('paginate_number'))
		{
			$int = Input::get('paginate_number');
			$publication = $publication->paginate($int);
			$view = $view->with('paginate_number',$int);
			$paginatorFilter .= '&paginate_number='.$int;
		}else
		{
			$publication = $publication->paginate(6);
		}	
	}
	public function getNewPublication()
	{
		$title 		= "Nuevo Publicación | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		$operations = Operation::get();
		$cat   		= Categoria::get();
		$city   	= City::get();
		return View::make('admin.publications.new')
		->with('title',$title)
		->with('cat',$cat)
		->with('city',$city)
		->with('operations',$operations);
	}
	public function postNewPub()
	{
		$data  = Input::all();
		$aux =  ImageController::imageValidation($data);
		$img_rules = $aux['rules'];
		$img_attr  = $aux['attr'];
		$rules 	= array_merge(array(
				'img.0'				=> 'required|image',
				'img'				=> 'min:1|max:15',
				'publication_cod'	=> 'required|unique:publications,publication_cod',
			),
			$this->publications_rules,
			$img_rules
		);
		$msg 	= array(
		);
		$attr 	= array_merge(array(
				'img.0'				=> 'imagen',
				'img'				=> 'imagen',
				'publication_cod'	=> 'código de la publicación',
			),
			$this->publications_attr,
			$img_attr
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$publication = new Publication;
		$this->savePublicationmData($publication, $data);
		$publication->save();
		
		$id = $publication->id;
		$publication_miscs 					= new PublicationMisc;
		$publication_miscs->publication_id 	= $id;
		$this->savePublicationDetails($data, $publication_miscs); 
		$publication_miscs->save();
		$file = Input::file();
		foreach($file['img'] as $f)
		{
			$img 				 = new PublicationImage;
			$img->publication_id = $id;
			$img->image   		 = ImageController::upload_image($f,$f->getClientOriginalName(),'images/publications/'.$id.'/');
			$img->save();
		}
		Session::flash('success','Publicación creado satisfactoriamente.');
		return Redirect::to('administracion/ver-publicaciones');

	}
	public function getPublications()
	{
		$title = "Ver publicaciones | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		$publications = Publication::with('category')
		->with('operation')
		->orderBy('id','DESC')
		->get();
		return View::make('admin.publications.show')
		->with('title',$title)
		->with('publications',$publications);
	}
	public function getPublicationDetails()
	{
		$data  = Input::all();
		$rules = array('id' => 'required|exists:publications,id');
		$msg   = array();
		$attr  = array('id' => 'id de la Publicación'); 
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Response::json(array(
				'type' => 'danger',
				'msg'  => $validator->getMessageBag()
			));
		}
		$id = Input::get('id');
		$publication = Publication::with('misc')->find($id);
		return View::make('partials.publicationDetails')
		->with('publication',$publication);
	}
	public function getMdfPub($id)
	{
		$title = "Modificar Publicación | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		$publication = Publication::with('misc')
		->with('images')
		->find($id);
		$operations = Operation::get();
		$cat   		= Categoria::get();
		return View::make('admin.publications.mdf')
		->with('title',$title)
		->with('cat',$cat)
		->with('operations',$operations)
		->with('publication',$publication);
	}
	public function postMdfPublication($id)
	{
		$data  = Input::all();
		$aux =  ImageController::imageValidation($data);
		$img_rules = $aux['rules'];
		$img_attr  = $aux['attr'];
		$rules 	= array_merge(array(
				'publication_cod'	=> 'required',
			),
			$this->publications_rules,
			$img_rules
		);
		$msg 	= array(
		);
		$attr 	= array_merge(array(
				'publication_cod'	=> 'código de la publicación',
			),
			$this->publications_attr,
			$img_attr
		);
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$publication = Publication::find($id);
		$this->savePublicationmData($publication, $data);
		$publication->save();
		
		$publication_miscs 					= PublicationMisc::where('publication_id','=',$id);
		if ($publication_miscs->count() < 1) {
			$publication_miscs = new PublicationMisc;
			$publication_miscs->publication_id = $id;
		}else
		{
			$publication_miscs = $publication_miscs->first();
		}
		$this->savePublicationDetails($data, $publication_miscs); 
		$publication_miscs->save();
		
		$file = Input::file();
		foreach($file['img'] as $file_id => $f)
		{
			if (!is_null($f)) {
				$img 				 = PublicationImage::where('id','=',$file_id)->where('publication_id','=',$id);
				if ($img->count() < 1) {
					$img = new PublicationImage;
					$img->publication_id = $id;
				}else
				{
					$img = $img->first();
					File::delete('images/publication/'.$id.'/'.$img->image);
				}
				$img->image   		 = ImageController::upload_image($f,$f->getClientOriginalName(),'images/publications/'.$id.'/');
				$img->save();
			}
		}
		Session::flash('success','Publicación modificada satisfactoriamente.');
		return Redirect::back();
	}
	public function postElimPubImg()
	{
		$data  = Input::all();
		$rules = array('id' => 'required|exists:publication_images,id');
		$msg   = array();
		$attr  = array('id' => 'id de la imagen'); 
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Response::json(array(
				'type' => 'danger',
				'msg'  => $validator->getMessageBag()
			));
		}
		$id = Input::get('id');
		$img = PublicationImage::find($id);
		File::delete('images/publication/'.$img->publication_id.'/'.$img->image);
		$img->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha eliminado la imagen satisfactoriamente.'
		));		
	}
	public function postElimPub()
	{
		$data  = Input::all();
		$rules = array('id' => 'required|exists:publications,id');
		$msg   = array();
		$attr  = array('id' => 'id de la publicación'); 
		$validator = Validator::make($data, $rules, $msg, $attr);
		if ($validator->fails()) {
			return Response::json(array(
				'type' => 'danger',
				'msg'  => $validator->getMessageBag()
			));
		}
		$id = Input::get('id');
		$populars    = Contact::where('publication_id','=',$id)->delete();
		$publication = Publication::find($id)->delete();
		return Response::json(array(
			'type' => 'success',
			'msg'  => 'Se ha eliminado la publicación satisfactoriamente.'
		));
	}
	public function getPublicationSelf($id)
	{
		$publication = Publication::with('misc')
		->with('images')
		->with('operation')
		->with('category')
		->with('city')
		->find($id);
		$related = Publication::where(function($query) use($publication){
			$query->where(function($price) use($publication){
				$price->where('price','>=',$publication->price-500000)
				->where('price','<=',$publication->price+500000);

			})
			->orWhereHas('misc',function($misc) use($publication){
				$misc->where('rooms','=',$publication->misc->rooms)
				->orWhere('bathrooms','=',$publication->misc->bathrooms)
				->orWhere('parking_slots','=',$publication->misc->parking_slots)
				->orWhere(function($size) use($publication){
					$size->where('size','>=',$publication->misc->size-100)
					->where('size','=',$publication->misc->size+100);
				});

			});
		})
		->where('id','!=',$id)
		->with('images')
		->with('misc')
		->with('operation')
		->take(4)
		->get();

		$populars = CommonTask::getPopulars();
		$title 	  = "Propiedad ".$publication->title.' | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.';
		$publicity = Publicity::where('ubication','=',3)->get();
		$categories = Categoria::get();
		$operations = Operation::get();
		$cities 	= City::get();
		$sideBar = View::make('partials.sideMenu');

		return View::make('publication.self')
		->with('title',$title)
		->with('publication',$publication)
		->with('related',$related)
		->with('populars',$populars)
		->with('sideBar',$sideBar->with('categories',$categories)->with('operations',$operations)->with('cities',$cities)->with('self','self'))
		->with('publicity',$publicity);
	}
	public function getSearch($subdomain = null)
	{
		$data = Input::all();

		$hasFilter = 0;
		
		$publications = Publication::with('images')
		->with('misc')
		->with('images')
		->with('category')
		->with('operation');
		$publicity = Publicity::where('ubication','=',2)->get();
		
		$populars 	= CommonTask::getPopulars();
		$categories = Categoria::get();
		$operations = Operation::get();
		$cities     = City::get();
		$paginatorFilter = '';

		$title    = "Búsqueda | Inversora Humboldt, venta, alquiler y remodelaciones de bienes raices.";
		
		$view = View::make('publication.search')
		->with('title',$title)
		->with('populars',$populars);
		$sideBar = View::make('partials.sideMenu');
		
		$this->searchFilters($publications, $paginatorFilter, $sideBar, $view, $data);
		$sideBar = $sideBar->with('paginatorFilter',$paginatorFilter);
		
		return $view->with('publications',$publications)
		->with('paginatorFilter',$paginatorFilter)
		->with('publicity',$publicity)
		->with('sideBar',$sideBar->with('categories',$categories)->with('operations',$operations)->with('cities',$cities));
	}
}