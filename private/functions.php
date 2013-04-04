<?php
	
	function prettyprint($var, $name=null) { if (false === empty($name)) $name .= " "; echo "<pre>$name".print_r($var, true)."</pre>"; }
	