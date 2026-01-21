<?php
/**
 * Class OccupancyPlan
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

/**
 * Class that encapsulates and handles everything that is related to the occupancy plan itself.
 */
final class OccupancyPlan
{
	/**
	 * @access private
	 * @staticvar OccupancyPlan $instance - singleton instance of this class
	 */
	private static $instance = null;	
	
	/**
	 * @access private
	 * @var array $occupancyData - data of the occupancy plan
	 */
	private $occupancyData = array();
	
	/**
	 * Constructor that is private so that it is not possible to get an instance of this class. Calls the
	 * loadOccupancyData method to load the occupancy plan data.
	 * 
	 * @access private
	 */
	private function __construct() 
	{ 
		$this->occupancyData = $this->loadOccupancyData();
	}
	
	/**
	 * Magic clone method that is private and empty.
	 * 
	 * @access private
	 */
	private function __clone() { } 
	
	/**
	 * Returns the singelton instance of this class.
	 * 
	 * @access public
	 * @static
	 * @return OccupancyPlan $occupancyPlan - occupancy plan object
	 */
	public static function getInstance()
	{
		if(self::$instance === null)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	/**
	 * Loads and returns occupancy data.
	 * 
	 * @access public
	 */
	public function loadOccupancyData()
	{
		$occupancyData = TextFileDatabase::loadOccupancyData();
		if(!empty($occupancyData)) return $occupancyData;
	}
	
	/**
	 * Saves occupancy data.
	 * 
	 * @access public
	 */
	public function saveOccupancyData()
	{
		TextFileDatabase::saveOccupancyData($this->occupancyData);
	}
	
	/**
	 * Returns the occupancy data for the given id.
	 * 
	 * @access public
	 * @param string $id- occupancy data id
	 */
	public function getOccupancyDataById($id)
	{
		if(!empty($id) && isset($this->occupancyData[$id]))
		{
			return $this->occupancyData[$id];
		}
	}
	
	/**
	 * Sets the occupancy data for the given id and the given day type.
	 * @param string $id- occupancy data id
	 * @param string $dayType - day type
	 */
	public function setOccupancyDataByIdAndDayType($id, $dayType)
	{
		if(!empty($id) && !empty($dayType))
		{
			$dayType = $dayType === 'null' ? null : $dayType;
			if(!is_null($dayType))
			{
				$this->occupancyData[$id] = $dayType;
			}
			else 
			{
				unset($this->occupancyData[$id]);
			}
		}		
	}
}
?>