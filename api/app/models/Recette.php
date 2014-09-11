<?php

class Recette extends \Eloquent {
	protected $fillable = ["idPays", "titre", "tpsprepa", "tpscuisson", "nbpersonne", "diff"];
}