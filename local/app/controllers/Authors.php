<?php

class Authors extends BaseController {

	public $restful = true;

	public function index()
	{
		return View::make('authors.index');
	}
}
