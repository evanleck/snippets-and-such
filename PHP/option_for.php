<?php
	
	// = depends on
	/*
		* param [https://github.com/elecklider/snippets-and-such/blob/master/PHP/param.php]
	*/
	
	// = cretates an option tag set to selected if GET, POST or COOKIE is set for it
	function option_for($val, $name, $text = '', $echo = true) {
		$sel = (param($name) == $val) ? "selected=\"selected\"" : "";
		$text = (!empty($text)) ? $text : $val;
		$ret = "<option $sel value=\"$val\">$text</option>";
		
		// = either echo or return. default is echo.
		if ($echo) {
			echo $ret;
		} else if (!$echo) {
			return $ret;
		}
	}

?>
