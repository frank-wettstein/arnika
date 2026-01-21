<?php
/**
 * Class SettingsHelper
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class with helper methods for the settings view.
 */
class SettingsHelper
{
	/**
	 * Constants for the settings.
	 * 
	 * @access const
	 */
	const APARTMENT_NAMES = 1;
	const NUMBER_OF_MONTHS_TO_DISPLAY = 2;
	const START_MONTH = 3;
	const HOME_LINK = 4;
	const REPEAT_DATE_ROW_NUMBER = 5;
	
	/**
	 * @access public
	 * @staticvar array $settingSelectNumbers - number of select options for the specified settings
	 */
	public static $settingSelectNumbers = array(
		self::APARTMENT_NAMES => 6,
		self::NUMBER_OF_MONTHS_TO_DISPLAY => 24,
		self::START_MONTH => 3,
		self::REPEAT_DATE_ROW_NUMBER => 5
	);
	
	/**
	 * @access public
	 * @staticvar array $startMonthOptions - start month options
	 */
	public static $startMonthOptions = array(
		1 => 'Aktueller Monat',
		2 => 'Letzter Monat',
		3 => 'Vorletzter Monat'
	);
	
	/**
	 * @access public
	 * @staticvar array $repeatDateRowNumberOptions
	 */
	public static $repeatDateRowNumberOptions = array(
		1 => array('value' => 0, 'caption' => '-'),
		2 => array('value' => 1, 'caption' => 'Jeden Monat'),
		3 => array('value' => 2, 'caption' => 'Alle 2 Monate'),
		4 => array('value' => 3, 'caption' => 'Alle 3 Monate'),
		5 => array('value' => 6, 'caption' => 'Alle 6 Monate')
	);

	
	/**
	 * Creates and checks select options for the given id and given setting.
	 * 
	 * @access public
	 * @static
	 * @param $id
	 * @param $setting
	 */
	public static function checkSelectStatusById($id, $setting)
	{
		if(isset($setting))
		{
			$compareSetting = '';
			switch($id)
			{
				case self::APARTMENT_NAMES:
					if(is_array($setting))
					{
						$compareSetting = count($setting);
					}
					break;
				case self::NUMBER_OF_MONTHS_TO_DISPLAY || self::START_MONTH || self::REPEAT_DATE_ROW_NUMBER:
					if(is_numeric($setting))
					{
						$compareSetting = $setting;
					}
					break;
				default:
					throw new Exception('');
			}
			for($i = 1; $i <= self::$settingSelectNumbers[$id]; $i++)
			{
				$selected = '';
				if($i === $compareSetting ||
					($id === self::REPEAT_DATE_ROW_NUMBER && self::$repeatDateRowNumberOptions[$i]['value'] === $compareSetting))
				{
					$selected = ' selected="selected"';
				}
				if($id === self::START_MONTH)
				{
					echo '<option'.$selected.' value="'.$i.'">'.self::$startMonthOptions[$i].'</option>';	
				}
				elseif($id === self::REPEAT_DATE_ROW_NUMBER)
				{
					echo '<option'.$selected.' value="'.self::$repeatDateRowNumberOptions[$i]['value'].'">'.self::$repeatDateRowNumberOptions[$i]['caption'].'</option>';
				}
				else 
				{
					echo '<option'.$selected.' value="'.$i.'">'.$i.'</option>';
				}
			}
		}
	}
	
	/**
	 * Creates apartment name textfields.
	 * 
	 * @access public
	 * @static
	 * @param array $apartmentNames
	 */
	public static function createApartmentNameTextfields(array $apartmentNames)
	{
		if(!empty($apartmentNames))
		{
			foreach($apartmentNames as $id => $apartmentName)
			{
				?>
				FeWo-Name: <input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo str_replace('__', ' ', $apartmentName); ?>" /><img src="../image-files/accept.png" id="<?php echo $id; ?>Img" width="16" height="16" alt="OK" title="OK" />
				<?php
			}
		}
	}
	
	/**
	 * Creates textfields for the given id and given setting.
	 * 
	 * @access public
	 * @static
	 * @param string $id - setting id
	 * @param string $setting - setting for the given id
	 */
	public static function createTextfieldById($id, $setting)
	{
		if(!empty($id) && isset($setting))
		{
			$cssId = '';
			switch($id) 
			{
				case self::HOME_LINK:
					$cssId = 'homeLink';
					break;
				default:
					throw new Exception();	
			}
			?>
			<input type="text" name="<?php echo $cssId; ?>" value="<?php echo $setting; ?>" />
			<?php	
		}
	}
	
	/**
	 * Handles form submit and collects all settings and saves them and forwards back to the settings view.
	 * 
	 * @access public
	 * @static
	 */
	public static function handleFormSubmit()
	{
		$apartmentNames = array();
		for($i = 1; $i <= self::$settingSelectNumbers[self::APARTMENT_NAMES]; $i++)
		{
			$id = 'Apartment'.$i;
			if(!empty($_POST[$id]))
			{
				$apartmentNames[$id] = str_replace(' ', '__', $_POST[$id]);
			}
		}
		$homeLink = isset($_POST['homeLink']) ? $_POST['homeLink'] : '';
		$numberOfMonthsToDisplay = !empty($_POST['numOfMonthsSelect']) && is_numeric($_POST['numOfMonthsSelect']) ? (int)$_POST['numOfMonthsSelect'] : 12;
		$repeatDateRowNumber = isset($_POST['repeatDateRowNumberSelect']) && is_numeric($_POST['repeatDateRowNumberSelect']) ? (int)$_POST['repeatDateRowNumberSelect'] : 0;
		$showAdminLink = !isset($_POST['showAdminLink']) ? false : true;
		$showLastUpdate = !isset($_POST['showLastUpdate']) ? false : true;
		$startMonth = !empty($_POST['startMonthSelect']) && is_numeric($_POST['startMonthSelect']) ? (int)$_POST['startMonthSelect'] : 1;
		$useMonthShortcutNames = !isset($_POST['useMonthShortcutNames']) ? false : true;
		$configuration = Configuration::getInstance();
		$configuration->setApartmentNames($apartmentNames);
		$configuration->setHomeLink($homeLink);
		$configuration->setNumberOfMonthsToDisplay($numberOfMonthsToDisplay);
		$configuration->setRepeatDateRowNumber($repeatDateRowNumber);
		$configuration->setShowAdminLink($showAdminLink);
		$configuration->setShowLastUpdate($showLastUpdate);
		$configuration->setStartMonth($startMonth);
		$configuration->setUseMonthShortcutNames($useMonthShortcutNames);
		$configuration->saveSettings();
		header("location: ../view-admin-files/settings.php");
		exit();
	}
}
?>