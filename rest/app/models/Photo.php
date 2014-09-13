<?php

class Photo extends Eloquent {
	protected $fillable = ['name'];

	public function recipes()
	{
	    return $this->belongsToMany('Recipe');
	}
}