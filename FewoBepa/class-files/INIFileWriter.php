<?php
/**
 * Class INIFileWriter
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class that writes data into an ini file.
 */
class INIFileWriter extends AbstractINIFileWrapper implements IFileWriter
{	
	/**
	 * @see interface-files/IFileWriter::write()
	 */
	public function write(array $data)
	{
		if(!empty($data))
		{
			$fileContent = '';
			if($this->useSections)
			{
				foreach($data as $sectionName => $sectionData)
				{
					$fileContent .= '['.$sectionName.']'."\n";
					$fileContent .= $this->convertINIDataIntoString($sectionData);
				}
			}
			else
			{
				$fileContent .= $this->convertINIDataIntoString($data);
			}
			file_put_contents($this->filePath.$this->fileName, $fileContent);
		}
	}
	
	/**
	 * Converts the given ini file data array into a valid ini file string.
	 * 
	 * @access private
	 * @param array $data - ini file data
	 * @return string $fileContent - ini file data as string
	 */
	private function convertINIDataIntoString(array $data)
	{
		if(!empty($data))
		{
			$fileContent = '';
			foreach($data as $dataName => $dataValue)
			{
				$fileContent .= $dataName.' = "'.$dataValue.'"'."\n";
			}
			return $fileContent;
		}
	}
}
?>