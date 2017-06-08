<?php

class Contact extends Eloquent {
	public function publication()
	{
		return $this->belongsTo('Publication','publication_id');
	}
}
