<?php
/**
 * Class CSVFileImporter
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class that imports data from a csv file.
 */
class CSVFileImporter extends AbstractCSVFileWrapper implements IFileImporter
{
	/**
	 * @access protected
	 * @var bool $hasColumnHeads - true if the first row just specifies the column headings
	 */
	protected $hasColumnHeads = false;
	
	/**
	 * @access protected 
	 * @var bool $useColumnHeadsAsDataKeys - true if column headings should be used as data keys
	 */
	protected $useColumnHeadsAsDataKeys = false;
	
	/**
	 * Sets the hasColumnHeads field.
	 * 
	 * @access public
	 * @param bool $hasColumnHeads - true if the first row just specifies the column headings
	 */
	public function setHasColumnHeads($hasColumnHeads)
	{
		if(isset($hasColumnHeads)) $this->hasColumnHeads = (bool)$hasColumnHeads;
	}
	
	/**
	 * Sets the useColumnHeadsAsDataKeys field. Furthermore sets the hasColumnHeads field on true.
	 * 
	 * @access public
	 * @param bool $useColumnHeadsAsDataKeys - true if column headings should be used as data keys
	 */
	public function setUseColumnHeadsAsDataKeys($useColumnHeadsAsDataKeys)
	{
		if(isset($useColumnHeadsAsDataKeys))
		{
			$this->useColumnHeadsAsDataKeys = (bool)$useColumnHeadsAsDataKeys;
			$this->hasColumnHeads = true;
		}
	}
	
	/**
	 * @see interface-files/IFileImporter::import()
	 */
	public function import()
	{
		if(file_exists($this->filePath.$this->fileName))
		{
			$importData = array();
			$fileHandle = fopen($this->filePath.$this->fileName, 'r');
			while(!feof($fileHandle))
			{
				$lineData = fgetcsv($fileHandle, 100, $this->delimiter, $this->enclosure);
				if(empty($lineData)) continue;
				$importData[] = $lineData;
			}
			if($this->hasColumnHeads)
			{
				if($this->useColumnHeadsAsDataKeys)
				{
					$tmpImportData = array();
					$importDataKeys = $importData[0];
					foreach($importData as $data)
					{
						$tmpImportData[] = array_combine($importDataKeys, $data);
					}
					$importData = $tmpImportData;
				}
				unset($importData[0]);
			}
			if(!empty($importData)) return $importData;
		}
	}
}
?>