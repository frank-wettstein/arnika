<?php
/**
 * Interface IFileImporter
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Interface that needs to be implemented by every file importer class.
 */
interface IFileImporter
{
	/**
	 * Imports data from a file.
	 * 
	 * @access public
	 * @return array $importData - imported data as array
	 */
	public function import();
}
?>