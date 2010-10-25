<?php

	// = cretates an option tag set to selected if either GET or POST is set for it
	function option_for($val, $name, $text, $echo = true) {
		$sel = ($_POST[$name] == $val || $_GET[$name] == $val) ? "selected=\"selected\"" : "";
		$text = isset($text) ? $text : $val;
		$ret = "<option $sel value=\"$val\">$text</option>";
		
		// = either echo or return. default is echo.
		if ($echo) {
			echo $ret;
		} else if (!$echo) {
			return $ret;
		}
	}

?>
