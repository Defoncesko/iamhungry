<?php

class QuantiteIngredientsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /quantiteingredients
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(QuantiteIngredient::get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /quantiteingredients/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /quantiteingredients
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /quantiteingredients/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 * PUT /quantiteingredients/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /quantiteingredients/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}