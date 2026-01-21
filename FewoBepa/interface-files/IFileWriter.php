<?php
/**
 * Interface IFileWriter 
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Interface that needs to be implemented by every file writer class.
 */
interface IFileWriter
{
	/**
	 * Writes the given data into a file.
	 * 
	 * @access public
	 * @param array $data - file data
	 */
	public function write(array $data);
}
?>