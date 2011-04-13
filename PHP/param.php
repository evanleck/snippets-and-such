<?php

	// = checks for cookie, then GET then POST & returns trimmed
	// = 	defaults to html escape the value but can be disabled
	function param($var, $escape = true) {
		$ret = "";
		if (isset($_POST[$var]) && !empty($_POST[$var])) {
			$ret = $_POST[$var];
		} elseif (isset($_GET[$var]) && !empty($_GET[$var])) {
			$ret = $_GET[$var];
		} elseif (isset($_COOKIE[$var]) && !empty($_COOKIE[$var])) {
			$ret = $_COOKIE[$var];
		}
		
		return ($escape) ? htmlspecialchars(trim($ret)) : trim($ret);
	}

?>