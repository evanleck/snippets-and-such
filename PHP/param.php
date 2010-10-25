<?php
	
	// = checks for either GET or POST value of $var and returns it
	function param( $var ) {
		$ret = "";
		if (isset($_GET[$var]) && $_GET[$var] != '') {
			$ret = $_GET[$var];
		}
		if (isset($_POST[$var]) && $_POST[$var] != '') {
			$ret = $_POST[$var];
		}
		return $ret;
	}


?>
