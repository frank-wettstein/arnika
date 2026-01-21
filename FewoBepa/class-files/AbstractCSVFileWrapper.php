<?php
/**
 * Class AbstractCSVFileWrapper
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Abstract class that provides basic structure for csv file writers and importers that needs to extend
 * this class.
 */
abstract class AbstractCSVFileWrapper extends AbstractFileWrapper
{
	/**
	 * @access protected
	 * @var string $delimiter - csv field delimiter
	 */
	protected $delimiter = ',';

	/**
	 * @access protected
	 * @var string $enclosure - csv field enclosure
	 */
	protected $enclosure = '"';

	/**
	 * Sets the csv field delimiter.
	 *
	 * @access public
	 *
	 * @param string $delimiter - csv field delimiter
	 */
	public function setDelimiter($delimiter)
	{
		if(!empty($delimiter)) {
			$this->delimiter = $delimiter;
		}
	}

	/**
	 * Sets the csv field enclosure.
	 *
	 * @access public
	 *
	 * @param string $enlosure - csv field enclosure
	 */
	public function setEnclosure($enclosure)
	{
		if(!empty($enclosure)) {
			$this->enclosure = $enclosure;
		}
	}

	/**
	 * Constructor that calls the parent constructor and initializes the delimiter and enclosure field.
	 *
	 * @access public
	 *
	 * @param string $fileName  - file name of the csv file
	 * @param string $filePath  - file path of the csv file
	 * @param string $delimiter - csv field delimiter
	 * @param string $enclosure - csv field enclosure
	 */
	public function __construct($fileName, $filePath, $delimiter = ',', $enclosure = '"')
	{
		parent::__construct($fileName, $filePath);
		$this->delimiter = $delimiter;
		$this->enclosure = $enclosure;
	}
}

?>