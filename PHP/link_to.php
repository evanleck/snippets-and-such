<?php

	// = link_to helper function
	function link_to( $text, $url, $current_class = "current", $title = "") {
		$uri = $_SERVER['REQUEST_URI'];
		$ret = "<a href=\"$url\" title=\"$title\"";
		
		// = check URI for path we're looking for
		if (stristr($uri, $url) && $url != '#' && $url != '/') {
			// = add $current_class as class if it matches
			$ret .= " data-uri=\"$uri\" class=\"$current_class\"";
		// = if we're looking for the root URL we have to do some fancyness
		} elseif ($url == '/' && $uri == '/') {
			$ret .= " class=\"$current_class\"";
		}
		echo $ret . ">$text</a>";
	}

?>
