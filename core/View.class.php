<?php

class View
{
	protected static $template_view = "default.php";

	public static function generate($content_view, $template_view = null, $data = null)
	{
		if (!$template_view) :
			$template_view = self::$template_view;
		endif;
		if ($data) :
			extract($data);
		endif;
		include VIEW_PATH . $template_view;
	}
}