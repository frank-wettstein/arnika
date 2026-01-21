<?php
/**
 * Interface IDatabase
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Interface that needs to be implemented by every database class that should work together with the
 * occupancy plan application.
 */
interface ILogger
{
	/**
	 * Constants for the log levels of the logger.
	 * 
	 * @access const
	 */
	const LOG_LEVEL_NOTICE = 1;
	const LOG_LEVEL_WARNING = 2;
	const LOG_LEVEL_ERROR = 3;
	
	/**
	 * Logs an entry with the given log level and the given message.
	 * 
	 * @access public
	 * @static
	 * @param $logLevel - log level
	 * @param $message - log message
	 */
	public static function logEntry($logLevel, $message);
}
?>