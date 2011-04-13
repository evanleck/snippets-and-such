<?php

	// = link_to helper function
	function link_to( $text, $url, $opts = "") {
		$uri = $_SERVER['REQUEST_URI'];
		$ret = "<a href=\"$url\" $opts ";
		
		// = check URI for path we're looking for
		if ($url != '/' && $url != '#' && stristr($uri, $url)) {
			// = add $current_class as class if it matches
			$ret .= " data-uri=\"$uri\" class=\"current\"";
		// = if we're looking for the root URL we have to do some fancyness
		} elseif ($url == '/' && $uri == '/') {
			$ret .= " class=\"current\"";
		}
		return $ret . ">$text</a>";
	}

?>
