<?php
	Class CommonTask
	{
		function __construct() {
		}
		public static function getPopulars()
		{
			return Contact::with(array('publication' => function($publication){
				$publication->with('images');
			}))
			->groupBy('publication_id')
			->orderBy('top_val','DESC')
			->take(4)
			->selectRaw('publication_id, count(publication_id) as top_val')
			->get();
		}
	}