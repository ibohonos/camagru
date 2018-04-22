<?php

class View
{
	protected static $template_view = "default.php";

	public static function generate($content_view, $data = null)
	{
		if ($data) :
			extract($data);
		endif;
		include VIEW_PATH . self::$template_view;
	}
}