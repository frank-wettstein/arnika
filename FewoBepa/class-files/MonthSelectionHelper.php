<?php
/**
 * Class MonthSelectionHelper
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class that manage the month selection of the occupancy plan.
 */
class MonthSelectionHelper
{
    /**
	 * @access const
	 * @var BACKWARD - x months backwards
	 */
    const BACKWARD = 1;

    /**
	 * @access const
	 * @var FORWARD - x months forwards
	 */
    const FORWARD = 2;

    /**
	 * Handles the incoming ajax request for the month selection.
	 *
	 * @access public
	 * @static
	 */
    public static function handleAjaxRequest()
    {
        if(isset($_POST['isAdmin']) && isset($_POST['isAdminPreview']) && isset($_POST['type']) &&
           isset($_POST['numOfMonths']) && isset($_POST['month']) && isset($_POST['year']) &&
           is_numeric($_POST['type']) && is_numeric($_POST['numOfMonths']) && is_numeric($_POST['month']) &&
           is_numeric($_POST['year']))
        {
            if($_POST['isAdmin'] === 'true')
            {
                $isAdmin = true;
            }
            else
            {
                $isAdmin = false;
            }

            if($_POST['isAdminPreview'] === 'true')
            {
                $isAdminPreview = true;
            }
            else
            {
                $isAdminPreview = false;
            }

            if((int)$_POST['type'] === self::BACKWARD)
            {
                self::buildBackwardMonthRows((int)$_POST['numOfMonths'], (int)$_POST['month'], (int)$_POST['year'], $isAdmin, $isAdminPreview);
            }
            elseif((int)$_POST['type'] === self::FORWARD)
            {
                self::buildForwardMonthRows((int)$_POST['numOfMonths'], (int)$_POST['month'], (int)$_POST['year'], $isAdmin, $isAdminPreview);
            }
        }
    }

    /**
	 * Creates the backward month rows.
	 *
	 * @access public
	 * @static
	 * @param int $numOfMonths - number of months
	 * @param int $month - current start month
	 * @param int $year - current start year
	 * @param bool $isAdmin - whether request is from admin area or not
	 * @param bool $isAdminPreview - whether request is from admin preview page
	 */
    public static function buildBackwardMonthRows($numOfMonths, $month, $year, $isAdmin, $isAdminPreview)
    {
        $currentYear = DateTimeUtil::getCurrentYear();
        $currentYearToDisplay = $year;
        $currentMonthToDisplay = $month;
        $tmpMonth = $currentMonthToDisplay;
        $tmpYear = $currentYearToDisplay;
        $count = 0;

        for($i = 0; $i < $numOfMonths; $i++)
        {
            $tmpMonth--;
            if($tmpMonth === 0)
            {
                $tmpMonth = 12;
                $tmpYear -= 1;
            }
            if($tmpYear < $currentYear - 1)
            {
                break;
            }
            $count++;
            if($numOfMonths === 1 && $i = 0)
            {
                break;
            }
        }

        for($i = 0; $i < $count; $i++)
        {
            $currentMonthToDisplay--;
            if($currentMonthToDisplay === 0)
            {
                $currentMonthToDisplay = 12;
                $currentYearToDisplay -= 1;
            }
        }

        if(!$isAdmin || ($isAdmin && $isAdminPreview))
        {
            OccuPlanViewHelper::createOccupancyPlan($currentMonthToDisplay, $currentYearToDisplay);
        }
        else
        {
            Session::write('viewMonth', $currentMonthToDisplay);
            Session::write('viewYear', $currentYearToDisplay);
            OccuPlanViewHelper::createOccupancyPlanForEdit($currentMonthToDisplay, $currentYearToDisplay);
        }

        $currentMonthToDisplay--;
        if($currentMonthToDisplay === 0)
        {
            $currentYearToDisplay -= 1;
        }

        if(($numOfMonths === 1 && $count === 0 ) || ($numOfMonths === 3 && $count < 3) || $currentYearToDisplay < $currentYear - 1)
        {
            echo ':::'.'backwardEnd';
        }
        else
        {
            echo ':::backward';
        }
    }

    /**
	 * Creates the forward month rows.
	 *
	 * @access public
	 * @static
	 * @param int $numOfMonths - number of months
	 * @param int $month - current start month
	 * @param int $year - current start year
	 * @param bool $isAdmin - whether request is from admin area or not
	 * @param bool $isAdminPreview - whether request is from admin preview page
	 */
    public static function buildForwardMonthRows($numOfMonths, $month, $year, $isAdmin, $isAdminPreview)
    {
        $configuration = Configuration::getInstance();
        $numberOfMonthsToDisplay = $configuration->getNumberOfMonthsToDisplay();
        $endYear = DateTimeUtil::getCurrentYear() + 3;
        $currentYearToDisplay = $year;
        $currentMonthToDisplay = $month;
        $tmpMonth = $currentMonthToDisplay;
        $tmpYear = $currentYearToDisplay;
        $count = 0;
        
        for($i = 1; $i < $numberOfMonthsToDisplay; $i++)
        {
            $tmpMonth++;
            if($tmpMonth === 13)
            {
                $tmpMonth = 1;
                $tmpYear += 1;
            }
        }

        for($i = 0; $i < $numOfMonths; $i++)
        {
            $tmpMonth++;
            if($tmpMonth === 13)
            {
                $tmpMonth = 1;
                $tmpYear += 1;
            }
            if($tmpYear >= $endYear)
            {
                break;
            }
            $count++;
            if($numOfMonths === 1 && $i = 0)
            {
                break;
            }
        }

        for($i = 0; $i < $count; $i++)
        {
            $currentMonthToDisplay++;
            if($currentMonthToDisplay === 13)
            {
                $currentMonthToDisplay = 1;
                $currentYearToDisplay += 1;
            }
        }

        if(!$isAdmin || ($isAdmin && $isAdminPreview))
        {
            OccuPlanViewHelper::createOccupancyPlan($currentMonthToDisplay, $currentYearToDisplay);
        }
        else
        {
            Session::write('viewMonth', $currentMonthToDisplay);
            Session::write('viewYear', $currentYearToDisplay);
            OccuPlanViewHelper::createOccupancyPlanForEdit($currentMonthToDisplay, $currentYearToDisplay);
        }

        for($i = 0; $i < $numberOfMonthsToDisplay; $i++)
        {
            $currentMonthToDisplay++;
            if($currentMonthToDisplay === 13)
            {
                $currentMonthToDisplay = 1;
                $currentYearToDisplay += 1;
            }
        }

        if(($numOfMonths === 1 && $count === 0) || ($numOfMonths === 3 && $count < 3) || $currentYearToDisplay >= $endYear)
        {
            echo ':::forwardEnd';
        }
        else
        {
            echo ':::forward';
        }
    }
}
?>
