<?php
/**
 * Class Session
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class that encapsulates everything related to session handling.
 */
class Session
{
	/**
	 * Creates and starts a session.
	 * 
	 * @access public
	 * @static
	 */
	public static function create()
	{
		session_start();
	}
	
	/**
	 * Checks if a specific session value exists for the given key.
	 * 
	 * @access public
	 * @static
	 * @param string $key - key of a specific session value
	 * @return true if value exists and false if not
	 */
	public static function check($key)
	{
		if(isset($_SESSION[$key])) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	/**
	 * Reads a specific session value exists for the given key.
	 * 
	 * @access public
	 * @static
	 * @param string $key - key of a specific session value
	 * @return unknown $value - value stored for the given session key
	 */
	public static function read($key)
	{
		if(isset($_SESSION[$key]))
		{
			return $_SESSION[$key];
		}
	} 
	
	/**
	 * Writes into the session the given value under the given key.
	 * 
	 * @access public
	 * @static
	 * @param string $key - key of a specific session value
	 * @param unknown $value - value shall be stored for the given session key
	 */
	public static function write($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	
	/**
	 * Deletes a specific session value for the given key.
	 * 
	 * @access public
	 * @static
	 * @param $key - key of a specific session value
	 */
	public static function delete($key)
	{
		if(isset($_SESSION[$key]))
		{
			unset($_SESSION[$key]);
		}
	}
	
	/**
	 * Destroys the a session.
	 * 
	 * @access public
	 * @static
	 */
	public static function destroy()
	{
		session_destroy();
	}
}
?>