<?php
/**
 * Class INIFileImporter
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class that imports data from an ini file.
 */
class INIFileImporter extends AbstractINIFileWrapper implements IFileImporter
{	
	/**
	 * @see interface-files/IFileImporter::import()
	 */
	public function import()
	{
		if(file_exists($this->filePath.$this->fileName))
		{
			$importData = parse_ini_file($this->filePath.$this->fileName, $this->useSections);
			if(!empty($importData)) return $importData;
		}
	}
}
?>