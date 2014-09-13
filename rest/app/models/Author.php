<?php

class Author extends \Eloquent {
	protected $fillable = ['name'];

	public function recipes()
	{
	    return $this->belongsToMany('Recipe');
	}
}