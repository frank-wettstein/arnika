<?php
/**
 * Interface IDatabase
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Interface that needs to be implemented by every database class that should work together with the
 * occupancy plan application.
 */
interface IDatabase
{
	/**
	 * Saves the given configuration settings into the database.
	 * 
	 * @access public
	 * @static
	 * @param array $settings - array( sectionName => array( settingName => settingValue ) )
	 */
	public static function saveConfiguration(array $settings);
	
	/**
	 * Loads the configuration settings from the database.
	 * 
	 * @access public
	 * @static
	 * @return array $settings - array( sectionName => array( settingName => settingValue ) )
	 */
	public static function loadConfiguration();
	
	/**
	 * Saves the given occupancy plan data into the database.
	 * 
	 * @access public
	 * @static
	 * @param array $occupancyData - array( id => dayType )
	 */
	public static function saveOccupancyData(array $occupancyData);
	
	/**
	 * Loads the occupancy plan data from the database.
	 * 
	 * @access public
	 * @static
	 * @return array $occupancyData - array( id => dayType )
	 */
	public static function loadOccupancyData();
}
?>