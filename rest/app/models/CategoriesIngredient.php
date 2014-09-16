<?php

class CategoriesIngredient extends \Eloquent {
	protected $fillable = ['name'];

	protected $hidden = array('pivot');
	
	public function recipes()
	{
	    return $this->belongsToMany('Recipe');
	}

	public function ingredients()
	{
		return $this -> belongsToMany('Ingredient','catingre_qutyingre_ingr_recipe');
	}

	public function quantities()
	{
		return $this -> belongsToMany('Quantity','catingre_qutyingre_ingr_recipe');
	}
}