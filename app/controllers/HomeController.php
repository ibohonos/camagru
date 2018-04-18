<?php

class HomeController extends Controller
{

	public function index()
	{
		View::generate("index.php");
	}

	public function not_404()
	{
		View::generate("404.php");
	}
}
