<?php
	
	// = because we use it.
	include 'option_for.php';

	// = spits out a set of option tags for states
	function states_for($name) {
		// = array of states
		$states = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "DC", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME","MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY", "AS", "GU", "MP", "PW", "PR", "UM", "VI", "AB", "BC", "MB", "NB", "NF", "NT", "NS", "ON", "PE", "PQ", "SK", "YT");
		$ret = option_for("State", $name, null, false);
		// = loop through them all, calling option_for for each one
		for ($i = 0; $i < count($states); $i++) { 
			$ret .= option_for($states[$i], $name, null, false);
		}
		echo $ret;
	}

?>
