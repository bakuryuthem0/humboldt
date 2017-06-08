<?php

class Publicity extends Eloquent {
	public function location()
	{
		return $this->belongsTo('Ubication','ubication');
	}
}
