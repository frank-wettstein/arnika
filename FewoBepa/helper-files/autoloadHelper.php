<?php
/**
 * AutoloadHelper
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Loads all needed classes if they exists.
 * 
 * @param string $className
 */
function __autoload($className)
{
	$filePath = dirname(__FILE__).'/../class-files/';
	if(file_exists($filePath.$className.'.php'))
	{
		require_once($filePath.$className.'.php');
	}
	else
	{
		throw new Exception();
	}	
}
?>