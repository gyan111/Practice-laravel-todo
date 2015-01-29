<?php 

class PagesController Extends BaseController {
	public function home()
	{
		$name = "Jnana Sahu";
		return View::make('hello')->with('name', $name);
	}
	public function about()
	{
		return View::make('about');
	}
}