<?php
/**
 * Class TextFileDatabase
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

// includes autoloader file
require_once(dirname(__FILE__).'/../helper-files/autoloadHelper.php');
// includes needed interface files
require_once(dirname(__FILE__).'/../interface-files/IDatabase.php');
require_once(dirname(__FILE__).'/../interface-files/IFileWriter.php');
require_once(dirname(__FILE__).'/../interface-files/IFileImporter.php');

/**
 * Class that saves and loads the configuration and occupancy plan data via a textfile.
 */
class TextFileDatabase implements IDatabase
{
	/**
	 * @access const
	 * @var FILE_PATH - file path for the save files
	 */
	const FILE_PATH = '../save-files/';

	/**
	 * @access const
	 * @var CONFIGURATION_FILE_NAME - file name for the configuration file
	 */
	const CONFIGURATION_FILE_NAME = 'configuration.ini';
	
	/**
	 * @access const
	 * @var OCUPANCY_DATA_FILE_NAME - file name for the occupancy plan data file
	 */
	const OCCUPANCY_DATA_FILE_NAME = 'occupancy-data.csv';
	
	/**
	 * Constructor declared as private in order to not get an instance of this class.
	 * 
	 * @access private
	 */
	private function __construct() { }
	
	/**
	 * @see interface-files/IDatabase::saveConfiguration()
	 */
	public static function saveConfiguration(array $settings)
	{
		if(!empty($settings))
		{
			$iniFileWriter = new INIFileWriter(self::CONFIGURATION_FILE_NAME, self::FILE_PATH, true);
			$iniFileWriter->write($settings);
		}
	}

	/**
	 * @see interface-files/IDatabase::loadConfiguration()
	 */
	public static function loadConfiguration()
	{
		$iniFileImporter = new INIFileImporter(self::CONFIGURATION_FILE_NAME, dirname(__FILE__).'/'.self::FILE_PATH, true);
		$settings = $iniFileImporter->import();
		if(!empty($settings)) return $settings;
	}
	
	/**
	 * @see interface-files/IDatabase::saveOccupancyData()
	 */
	public static function saveOccupancyData(array $occupancyData)
	{
		if(isset($occupancyData))
		{
			$tmpOccupancyData = array();
			foreach($occupancyData as $id => $dayType)
			{
				$tmpOccupancyData[] = array($id, $dayType);
			}
			$csvFileWriter = new CSVFileWriter(self::OCCUPANCY_DATA_FILE_NAME, self::FILE_PATH, ';', '"');
			$csvFileWriter->setColumnHeads(array('Id', 'DayType'));
			$csvFileWriter->setUseColumnHeads(true);
			$csvFileWriter->write($tmpOccupancyData);
		}
	}
	
	/**
	 * @see interface-files/IDatabase::loadOccupancyData()
	 */
	public static function loadOccupancyData()
	{
		$csvFileImporter = new CSVFileImporter(self::OCCUPANCY_DATA_FILE_NAME, dirname(__FILE__).'/'.self::FILE_PATH, ';', '"');
		$csvFileImporter->setHasColumnHeads(true);
		$csvFileImporter->setUseColumnHeadsAsDataKeys(true);
		$importData = $csvFileImporter->import();
		if(!empty($importData))
		{
			$occupancyData = array();
			foreach($importData as $data)
			{
				$occupancyData[$data['Id']] = $data['DayType'];
			}
			return $occupancyData;
		}
	}
}
?>