<?php

class CategoriesPreparation extends \Eloquent {
	protected $fillable = ['name'];

	protected $hidden = array('pivot');

	public function recipes()
	{
	    return $this->belongsToMany('Recipe');
	}

	public function sentencespreparation()
	{
		return $this -> belongsToMany('SentencesPreparation','catprepa_sentenceprepa_recipe');
	}
}