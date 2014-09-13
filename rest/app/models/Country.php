<?php

class Country extends Eloquent {
	protected $table = 'countries';

	protected $fillable = ['name'];

	public function recipes()
	{
	    return $this->hasMany('Recipe');
	}
}