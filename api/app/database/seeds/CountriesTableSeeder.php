<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CountriesTableSeeder extends Seeder {

	public function run()
	{

		$countries = array("France","Belgique","USA");

		for ($i=0; $i < sizeof($countries); $i++) { 
			Country::create([
				"nom" => $countries[$i]
			]);
		}
	}

}

