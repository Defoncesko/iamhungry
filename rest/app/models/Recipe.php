<?php

class Recipe extends Eloquent {
	protected $fillable = ['country_id','title'];

	public function authors()
	{
	    return $this -> belongsToMany('Author');
	}

	public function countries()
	{
		return $this -> belongsToMany('Country');
	}

	public function photos()
	{
		return $this -> belongsToMany('Photo');
	}

	public function categories()
	{
		return $this -> belongsToMany('Category');
	}

	public function categoriespreparation()
	{
		return $this -> belongsToMany('CategoriesPreparation','catprepa_sentenceprepa_recipe');
	}
}