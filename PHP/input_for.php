<?php

	// = depends on
	/*
		* param [https://github.com/elecklider/snippets-and-such/blob/master/PHP/param.php]
	*/
	
	// = form input helper
	/* = 
	
		* checks for COOKIE, GET or POST values for the passed in variable
		* expects either a string containing the variable for the input
			** or **
		* an array similar to $defaults that specifies the necessary variables
	
	= */
	function input_for($opts) {
		$defaults = array(
			'type' => 		'text',
			'var' => 		 null,
			'disabled' => 	 false,
			'class' => 		'',
			'options' => 	'',
			'value' => 		''
		);
		// = handles a single param call
		// =   input_for("first_name") is the same as input_for(array('var' => 'first_name'))
		if (is_string($opts)) {
			$opts = array('var' => $opts);
		}
		// = Catch and throw error for no defined array.
		if (!is_array($opts) || !isset($opts['var'])) { echo "No var defined for input_for(). Breaking."; return 0; }
		
		// = merge defaults with defined values for total bliss
		$opts = array_merge($defaults, $opts);
		
		if (empty($opts['value']) || param($opts['var']) != '') {
			$opts['value'] = param($opts['var']);
		}
		
		// = tack on disabled string if necessary
		if ($opts['disabled']) {
			$opts['disabled'] = "disabled=\"disabled\"";
		}
		// = put it all together
		echo "<input type=\"".$opts['type']."\" name=\"".$opts['var']."\" id=\"".$opts['var']."\" ".$opts['disabled']." class=\"".$opts['class']."\" ".$opts['options']." value=\"".$opts['value']."\" />";
	}
	
	// = usage:
	/*
		Simple:
			input_for('first_name');
		
		Advanced:
			input_for(array('var' => 'first_name', 'type' => 'password', 'value' => 'default value'));
		
	*/
	
?>
