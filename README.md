##API
	
	
######-> Récupérer une recette :

	{local}/rest/public/recipes/{id}
	
######-> Récupérer les recettes d'une catégorie :

	{local}/rest/recettes/{id}
	
######-> Récupérer les sous-catégories d'une catégorie :

	{local}/rest/recettes/{id}
	
######-> Récupérer les catégories d'ingrédients

	{local}/rest/public/categorieingredients
	
######-> Récupérer les autheurs

	{local}/rest/public/authors
	
######-> Récupérer les catégories de recettes

	{local}/rest/public/categories
	
######-> Récupérer les catégories des préparations des recettes

	{local}/rest/public/categoriepreparations

######-> Récupérer les pays

	{local}/rest/public/countries
	
######-> Récupérer les ingredients

	{local}/rest/public/ingredients
	
######-> Récupérer les photos

	{local}/rest/public/photos

######-> Recherche une recette par mot clef (title,ingredients,advice)

	{local}/rest/public/recipes/search/{txt}
	
######-> Recherche les recettes par fourchette

	{local}/rest/public/recipes/{valuedep}/{valuefin}