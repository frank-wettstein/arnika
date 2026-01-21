<?php
/**
 * Class DateTimeUtil
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class that provides useful date time functions.
 */
final class DateTimeUtil
{
	/**
	 * @access const
	 * @var MAX_DAY_NUM - maximum day number of a month
	 */
	const MAX_MONTH_DAY_NUM = 31;
	
	/**
	 * @access private
	 * @staticvar array $monthNames - month names
	 */
	private static $monthNames = array(
		'Januar', 
		'Februar', 
		'Maerz', 
		'April', 
		'Mai', 
		'Juni', 
		'Juli', 
		'August', 
		'September', 
		'Oktober', 
		'November', 
		'Dezember'
	);
	
	/**
	 * @access private
	 * @staticvar array $monthShortcutNames - month shortcut names
	 */
	private static $monthShortcutNames = array(
		'Jan', 
		'Feb', 
		'Mrz', 
		'Apr', 
		'Mai', 
		'Jun', 
		'Jul',
		'Aug',
		'Sep',
		'Okt',
		'Nov',
		'Dez'
	);
	
	/**
	 * @access private
	 * @staticvar $weekdayShortcutNames - weekday shortcut names
	 */
	private static $weekdayShortcutNames = array('So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa');
	
	/**
	 * Constructor that is private so that it is not possible to get an instance of this class.
	 * 
	 * @access private
	 */
	private function __construct() { }
	
	/**
	 * Returns the current month as two digit number.
	 * 
	 * @access public
	 * @static
	 * @return int $currentMonth - current month as two digit number
	 */
	public static function getCurrentMonth()
	{
		return intval(date('m', time()));
	}
	
	/**
	 * Returns the current year as four digit number.
	 * 
	 * @access public
	 * @static
	 * @return int $currentYear - current year as four digit number
	 */
	public static function getCurrentYear()
	{
		return intval(date('Y', time()));
	}
	
	/**
	 * Returns the month name for the given month. Month has to be a valid number between 1 and 12.
	 * 
	 * @access public
	 * @static
	 * @param int $month - month number
	 * @param bool $asShortcurtName - true if method should return the month shortcut name
	 * @return string $monthName - month name
	 */
	public static function getMonthName($month, $asShortcurtName = false)
	{
		if(!empty($month) && (intval($month) >= 1 && intval($month) < 13))
		{
			if($asShortcurtName)
			{
				return self::$monthShortcutNames[$month - 1];
			}
			else 
			{
				return self::$monthNames[$month - 1];
			}
		}
	}
	
	/**
	 * Returns the weekday shortcut name of the given date.
	 * 
	 * @access public
	 * @static
	 * @param string $date - date with the format: dd.mm.YYYY
	 * @return string $weekdayShortcutName - weekday shortcut name of the given date
	 */
	public static function getWeekdayShortcutName($date)
	{
		if(preg_match('/^\d{1,2}\.\d{1,2}\.\d{4}$/', $date))
		{
			$splitDate = explode('.', $date);
			$date = mktime(0, 0, 0, intval($splitDate[1]), intval($splitDate[0]), intval($splitDate[2]));
			return self::$weekdayShortcutNames[date('w', $date)];
		}
	}
}
?>