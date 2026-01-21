<?php
/**
 * Class Configuration
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
 * Class that encapsulates and handles all settings of the occupancy plan application.
 */
final class Configuration
{
	/**
	 * Constants for the ini file sections.
	 * 
	 * @access const
	 */
	const SECTION_APARTMENT_NAMES = 'ApartmentNames';
	const SECTION_COLOURS = 'Colours';
	const SECTION_COLOUR_TYPES = 'ColourTypes';
	const SECTION_FONT = 'Font';
	const SECTION_FOOTER_INFORMATIONS = 'FooterInformations';
	const SECTION_GENERAL = 'General';
	const SECTION_MONTH = 'Month';
	
	/**
	 * @access private
	 * @staticvar Configuration $instance - singleton instance of this class
	 */
	private static $instance = null;
	
	/**
	 * @access private
	 * @var array $settings - all settings needed for the occupancy plan application
	 */
	private $settings = array();
	
	/**
	 * Constructor that is private so that it is not possible to get an instance of this class. Calls the
	 * loadSettings method to load all settings.
	 * 
	 * @access private
	 */
	private function __construct() 
	{ 
		$this->settings = $this->loadSettings();
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
	 * @return Configuration $configuration - configuration with all settings
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
	 * Loads all configuration settings needed for the occupancy plan application.
	 * 
	 * @access private
	 * @return array $settings - all settings needed for the occupancy plan application
	 */
	private function loadSettings()
	{
		$settings = TextFileDatabase::loadConfiguration();
		if(!empty($settings)) return $settings;
	}
	
	/**
	 * Saves all configuration settings needed for the occupancy plan application.
	 * 
	 * @access public
	 */
	public function saveSettings()
	{
		TextFileDatabase::saveConfiguration($this->settings);
	}
	
	/**
	 * Returns the apartment names.
	 * 
	 * @access public
	 * @return array $apartmentNames
	 */
	public function getApartmentNames()
	{
		return $this->settings[self::SECTION_APARTMENT_NAMES];
	}
	
	/**
	 * Sets the apartment names.
	 * 
	 * @access public
	 * @param array $apartmentNames
	 */
	public function setApartmentNames(array $apartmentNames)
	{
		if(!empty($apartmentNames) && count($apartmentNames) > 0 && count($apartmentNames) <= SettingsHelper::$settingSelectNumbers[SettingsHelper::APARTMENT_NAMES])	
		{
			$this->settings[self::SECTION_APARTMENT_NAMES] = $apartmentNames;
		}
	}	
	
	/**
	 * Returns the colours.
	 * 
	 * @access public
	 * @return array $colours
	 */
	public function getColours()
	{
		return $this->settings[self::SECTION_COLOURS];
	}
	
	/**
	 * Sets the colours.
	 * 
	 * @access public
	 * @param array $colours
	 */
	public function setColours(array $colours)
	{
		if(!empty($colours))
		{
			$this->settings[self::SECTION_COLOURS] = $colours;
		}
	}
	
	/**
	 * Returns the colour types.
	 * 
	 * @access public
	 * @return array $colourTypes
	 */
	public function getColourTypes()
	{
		return $this->settings[self::SECTION_COLOUR_TYPES];
	}
	
	/**
	 * Sets the colour types.
	 * 
	 * @access public
	 * @param array $colourTypes
	 */
	public function setColourTypes(array $colourTypes)
	{
		if(!empty($colourTypes))
		{
			$this->settings[self::SECTION_COLOUR_TYPES] = $colourTypes;
		}
	}
	
	/**
	 * Returns the font family.
	 * 
	 * @access public
	 * @return string $fontFamily
	 */
	public function getFontFamily()
	{
		return $this->settings[self::SECTION_FONT]['FontFamily'];
	}
	
	/**
	 * Sets the font family.
	 * 
	 * @access public
	 * @param string $fontFamily
	 */
	public function setFontFamily($fontFamily)
	{
		if(!empty($fontFamily) && in_array($fontFamily, DesignHelper::$fontFamilyChoiceList))
		{
			$this->settings[self::SECTION_FONT]['FontFamily']= $fontFamily;
		}
	}
	
	/**
	 * Returns the font size.
	 * 
	 * @access public
	 * @return string $fontSize
	 */
	public function getFontSize()
	{
		return $this->settings[self::SECTION_FONT]['FontSize'];
	}
	
	/**
	 * Sets the font size
	 * 
	 * @access public 
	 * @param sting $fontSize
	 */
	public function setFontSize($fontSize)
	{
		if(!empty($fontSize) && in_array($fontSize, DesignHelper::$fontSizeChoiceList))
		{
			$this->settings[self::SECTION_FONT]['FontSize'] = $fontSize;
		}
	}
	
	/**
	 * Returns the home link.
	 * 
	 * @access public
	 * @return string $homeLink
	 */
	public function getHomeLink()
	{
		return $this->settings[self::SECTION_GENERAL]['HomeLink'];
	}
	
	/**
	 * Sets the home link.
	 * 
	 * @access public
	 * @param string $homeLink
	 */
	public function setHomeLink($homeLink)
	{
		if(isset($homeLink)) 
		{
			$this->settings[self::SECTION_GENERAL]['HomeLink'] = $homeLink;
		}
	}
	
	/**
	 * Returns the number of months that shall be displayed.
	 * 
	 * @access public
	 * @return int $numberOfMonthsToDisplay
	 */
	public function getNumberOfMonthsToDisplay()
	{
		return (int)$this->settings[self::SECTION_MONTH]['NumberOfMonthsToDisplay'];
	}
	
	/**
	 * Sets the number of months that shall be displayed.
	 * 
	 * @access public
	 * @param int $numberOfMonthsToDisplay
	 */
	public function setNumberOfMonthsToDisplay($numberOfMonthsToDisplay)
	{
		if(!empty($numberOfMonthsToDisplay) && $numberOfMonthsToDisplay > 0 && $numberOfMonthsToDisplay <= SettingsHelper::$settingSelectNumbers[SettingsHelper::NUMBER_OF_MONTHS_TO_DISPLAY])
		{
			$this->settings[self::SECTION_MONTH]['NumberOfMonthsToDisplay'] = (int)$numberOfMonthsToDisplay;
		}
	}
	
	/**
	 * Returns the number of months after that the date row shall be displayed again.
	 * 
	 * @access public
	 * @return int $repeatDateRowNumber
	 */
	public function getRepeatDateRowNumber()
	{
		return (int)$this->settings[self::SECTION_GENERAL]['RepeatDateRowNumber'];
	}
	
	/**
	 * Sets the number of months after that the date row shall be displayed again.
	 * 
	 * @access public
	 * @param int $repeatDateRowNumber
	 */
	public function setRepeatDateRowNumber($repeatDateRowNumber)
	{
		if(isset($repeatDateRowNumber))
		{
			$this->settings[self::SECTION_GENERAL]['RepeatDateRowNumber'] = (int)$repeatDateRowNumber;
		}
	}
	
	/**
	 * Returns the show admin link indicator.
	 * 
	 * @access public
	 * @retur bool $showAdminLink
	 */
	public function getShowAdminLink()
	{
		return (bool)$this->settings[self::SECTION_GENERAL]['ShowAdminLink'];
	}
	
	/**
	 * Sets the show admin link indicator.
	 * 
	 * @access public
	 * @param bool $showAdminLink
	 */
	public function setShowAdminLink($showAdminLink)
	{
		if(isset($showAdminLink))
		{
			$this->settings[self::SECTION_GENERAL]['ShowAdminLink'] = (bool)$showAdminLink;
		}
	}
	
	/**
	 * Returns the show copyright indicator.
	 * 
	 * @access public
	 * @retur bool $showCopyright
	 */
	public function getShowCopyright()
	{
		return (bool)$this->settings[self::SECTION_FOOTER_INFORMATIONS]['ShowCopyright'];
	}
	
	/**
	 * Sets the show copyright indicator.
	 * 
	 * @access public
	 * @param bool $showCopyright
	 */
	public function setShowCopyright($showCopyright)
	{
		if(isset($showCopyright))
		{
			$this->settings[self::SECTION_FOOTER_INFORMATIONS]['ShowCopyright'] = (bool)$showCopyright;
		}
	}
	
	/**
	 * Returns the show last update indicator.
	 * 
	 * @access public
	 * @retur bool $showLastUpdate
	 */
	public function getShowLastUpdate()
	{
		return (bool)$this->settings[self::SECTION_FOOTER_INFORMATIONS]['ShowLastUpdate'];
	}
	
	/**
	 * Sets the show last update indicator.
	 * 
	 * @access public
	 * @param bool $showLastUpdate
	 */
	public function setShowLastUpdate($showLastUpdate)
	{
		if(isset($showLastUpdate))
		{
			$this->settings[self::SECTION_FOOTER_INFORMATIONS]['ShowLastUpdate'] = (bool)$showLastUpdate;
		}
	}
	
	/**
	 * Returns the start month.
	 * 
	 * @access public
	 * @return int $startMonth
	 */
	public function getStartMonth()
	{
		return (int)$this->settings[self::SECTION_MONTH]['StartMonth'];
	}
	
	/**
	 * Sets the start month.
	 * 
	 * @access public
	 * @param int $startMonth
	 */
	public function setStartMonth($startMonth)
	{
		if(!empty($startMonth))
		{
			$this->settings[self::SECTION_MONTH]['StartMonth'] = (int)$startMonth;
		}
	}
	
	/**
	 * Returns the use month shortcut indicator.
	 * 
	 * @access public
	 * @return bool $useMonthShortcutNames
	 */
	public function getUseMonthShortcutNames()
	{
		return (bool)$this->settings[self::SECTION_MONTH]['UseMonthShortcutNames'];
	}
	
	/**
	 * Sets the use month shortcut indicator.
	 * 
	 * @access public
	 * @param bool $useMonthShortcutNames
	 */
	public function setUseMonthShortcutNames($useMonthShortcutNames)
	{
		if(isset($useMonthShortcutNames))
		{
			$this->settings[self::SECTION_MONTH]['UseMonthShortcutNames'] = (bool)$useMonthShortcutNames;
		}
	}
}
?>