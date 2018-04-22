<?php

class HomeController extends Controller
{

	public function index()
	{
		$home = new HomeModel;
		$data = $home->get_data();
		View::generate("index.php", $data);
	}

	public function not_404()
	{
		View::generate("404.php");
	}
}
