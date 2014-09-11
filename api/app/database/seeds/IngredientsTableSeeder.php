<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class IngredientsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('ingredients')->delete();

		Ingredient::create([
				"nom"=>"sel"
			]);
		Ingredient::create([
				"nom"=>"poivre"
			]);	
		Ingredient::create([
				"nom"=>"farine"
			]);	
		Ingredient::create([
				"nom"=>"levure"
			]);	
	}

}