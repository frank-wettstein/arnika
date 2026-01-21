<?php
/**
 * Class AbstractFileWrapper
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Abstract class that provides basic structure for file writers and importers that needs to extend 
 * this class.
 */
abstract class AbstractFileWrapper
{
	/**
	 * @access protected
	 * @var string $fileName - file name
	 */
	protected $fileName = '';
	
	/**
	 * @access protected
	 * @var string $filePath - file path
	 */
	protected $filePath = '';
		
	/**
	 * Constructor that initializes the file name and file path.
	 * 
	 * @access public
	 * @param string $fileName - file name
	 * @param string $filePath - file path
	 */
	public function __construct($fileName, $filePath)
	{
		$this->fileName = $fileName;
		$this->filePath = $filePath;
	}
	
	/**
	 * Returns the file name.
	 * 
	 * @access public
	 * @return string $fileName - file name
	 */
	public function getFileName()
	{
		return $this->fileName;
	}
	
	/**
	 * Sets the file name.
	 * 
	 * @access public
	 * @param string $fileName - file name
	 */
	public function setFileName($fileName)
	{
		if(!empty($fileName)) $this->fileName = $fileName;
	}
	
	/**
	 * Returns the file path.
	 * 
	 * @access public
	 * @return string $filePath - file path
	 */
	public function getFilePath()
	{
		return $this->filePath;
	}
	
	/**
	 * Sets the file path.
	 * 
	 * @access public
	 * @param string $filePath - file path
	 */
	public function setFilePath($filePath)
	{
		if(!empty($filePath)) $this->filePath = $filePath;
	}
}
?>