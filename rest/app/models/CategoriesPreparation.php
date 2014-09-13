<?php

class CategoriesPreparation extends \Eloquent {
	protected $fillable = ['name'];

	public function recipes()
	{
	    return $this->belongsToMany('Recipe');
	}

	public function sentencespreparation()
	{
		return $this -> belongsToMany('SentencesPreparation','catprepa_sentenceprepa_recipe');
	}
}