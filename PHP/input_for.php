<?php
	// = form input helper
	/* = 

		* checks for GET or POST values for the passed in variable
		* expects either a string containing the variable for the input
			** or **
		* an array similar to $defaults that specifies the necessary variables

	= */
	function input_for($opts) {
		try {
			$defaults = array(
				'type' => 		'text',
				'var' => 		 null,
				'disabled' => 	 false,
				'class' => 		'',
				'options' => 	'',
				'value' => 		''
			);
			// = handles a single param call
			// =   input_for("first_name") == input_for(array('var' => 'first_name'))
			if (is_string($opts)) {
				$opts = array('var' => $opts);
			}
			// = Catch and throw error for no defined array.
			if (!is_array($opts) || !isset($opts['var'])) { throw new Exception("No var defined for input_for(). Breaking."); }
			
			// = merge defaults with defined values for total bliss
			$opts = array_merge($defaults, $opts);
			
			// = check for GET
			if (isset($_GET[$opts['var']])) {
				$opts['value'] = $_GET[$opts['var']];
			}
			// = check for POST (will override GET)
			if (isset($_POST[$opts['var']])) {
				$opts['value'] = $_POST[$opts['var']];
			}
			// = tack on disabled string if necessary
			if ($opts['disabled']) {
				$opts['disabled'] = "disabled=\"disabled\"";
			}
			// = put it all together
			echo "<input type=\"".$opts['type']."\" name=\"".$opts['var']."\" id=\"".$opts['var']."\" ".$opts['disabled']." class=\"".$opts['class']."\" ".$opts['options']." value=\"".$opts['value']."\" />";
		} catch (Exception $input_for_error) {
			echo "Exception caught: $input_for_error";
		}
	}
	
?>
