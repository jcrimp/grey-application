<?php

//common.php

/**
 * Automatically loads classes by name when called.  This saves resources, as  
 * only pages that need to reference the class actually load it.
 *
 * The autoload function allows us to name a file after the class, and customize it to 
 * meet our needs, but load the file requiring the class by assuming the file name based on 
 * the name of the class.  In our case, we'll add '.php', which follows our pattern. 
 *
 *<code>
 *$myObject = new myClass();
 *</code>
 *  
 * @param str $class_name Class to be loaded as needed
 * @return void
 */

function __autoload($class_name) 
{
    if(file_exists(INCLUDE_PATH . $class_name . '.php'))
    {
    	include INCLUDE_PATH . $class_name . '.php';
	}
}#end __autoload()
