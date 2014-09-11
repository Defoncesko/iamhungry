<?php

class PhrasePrepasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /phraseprepas
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(PhrasePrepa::get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /phraseprepas/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /phraseprepas
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /phraseprepas/{id}
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
	 * PUT /phraseprepas/{id}
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
	 * DELETE /phraseprepas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}