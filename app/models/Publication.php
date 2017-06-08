<?php

class Publication extends Eloquent {
	public function category()
	{
		return $this->belongsTo('Categoria','category_id');
	}
	public function operation()
	{
		return $this->belongsTo('Operation','operation_id');
	}
	public function misc()
	{
		return $this->hasOne('PublicationMisc','publication_id');
	}
	public function images()
	{
		return $this->hasMany('PublicationImage','publication_id');
	}
}
