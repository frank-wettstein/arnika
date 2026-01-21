<?php
/**
 * Class AbstractINIFileWrapper
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Abstract class that provides basic structure for ini file writers and importers that needs to extend 
 * this class.
 */
abstract class AbstractINIFileWrapper extends AbstractFileWrapper
{
	/**
	 * @access protected
	 * @var bool $useSections - false if no ini file sections to write otherwise true
	 */
	protected $useSections = false;

	/**
	 * Constructor that calls the parent constructor and initializes the useSections field.
	 * 
	 * @access public
	 * @param string $fileName - file name of the ini file
	 * @param string $filePath - file path of the ini file  
	 * @param bool $useSections - false if no ini file sections to write otherwise true
	 */
	public function __construct($fileName, $filePath, $useSections = false)
	{
		parent::__construct($fileName, $filePath);
		$this->useSections = (bool)$useSections;
	}
	
	/**
	 * Sets the useSections field.
	 * 
	 * @access public
	 * @param bool $useSections - false if no ini file sections to write otherwise true
	 */
	public function setUseSections($useSections)
	{
		if(isset($useSections))	$this->useSections = (bool)$useSections;
	}
}
?>