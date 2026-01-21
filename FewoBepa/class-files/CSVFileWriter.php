<?php
/**
 * Class CSVFileWriter
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class that writes data into a csv file.
 */
class CSVFileWriter extends AbstractCSVFileWrapper implements IFileWriter
{
	/**
	 * @access protected
	 * @var bool $useColumnHeads - true if first row columns used as column headings
	 */
	protected $useColumnHeads = false;
	
	/**
	 * @access protected
	 * @var array $columnHeads - the column headings
	 */
	protected $columnHeads = array();
	
	/**
	 * Sets the useColumnHeads field.
	 * 
	 * @access public
	 * @param bool $useColumnHeads - true if first row columns used as column headings
	 */
	public function setUseColumnHeads($useColumnHeads)
	{
		if(isset($useColumnHeads)) $this->useColumnHeads = (bool)$useColumnHeads;
	}
	
	/**
	 * Sets the column heads.
	 * 
	 * @access public
	 * @param array $columnHeads - the column headings
	 */
	public function setColumnHeads(array $columnHeads)
	{
		if(!empty($columnHeads)) $this->columnHeads = $columnHeads;
	}
	
	/**
	 * @see interface-files/IFileWriter::write()
	 */
	public function write(array $data)
	{
		if(isset($data))
		{
			$fileContent = '';
			if($this->useColumnHeads && !empty($this->columnHeads))
			{
				foreach($this->columnHeads as $columnHead)
				{
					$fileContent .= $this->enclosure.$columnHead.$this->enclosure.$this->delimiter;
				}
				$fileContent = $this->convertLastDelimiterIntoNewline($fileContent);
			}
			foreach($data as $columnData)
			{
				foreach($columnData as $columnValue)
				{
					$fileContent .= $this->enclosure.$columnValue.$this->enclosure.$this->delimiter;
				}
				$fileContent = $this->convertLastDelimiterIntoNewline($fileContent);
			}
			file_put_contents($this->filePath.$this->fileName, $fileContent);
		}
	}
	
	/**
	 * Converts the last unneeded delimiter into a newline sign.
	 * 
	 * @access private
	 * @param string $fileContent - csv file content
	 * @return string $fileContent - csv file content with newline sign at the end
	 */
	private function convertLastDelimiterIntoNewline($fileContent)
	{
		$fileContent = substr($fileContent, 0, mb_strlen($fileContent) - 1);
		$fileContent .= "\n";
		return $fileContent;
	}
}
?>