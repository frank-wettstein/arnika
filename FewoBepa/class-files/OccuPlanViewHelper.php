<?php
/**
 * Class OccuPlanViewHelper
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class with helper methods for the views that displaying the occupancy plan.
 */
class OccuPlanViewHelper
{
	/**
	 * Creates the occupancy plan footer.
	 * 
	 * @access public
	 * @static
	 * @param bool $showCopyright - show copyright indicator
	 * @param bool $showLastUpdate - show last update indicator
	 */
	public static function createFooter($showCopyright, $showLastUpdate)
	{
		if($showCopyright || $showLastUpdate)
		{
			?>
			<tr id="occuPlanTrFooter">
			<?php
		} 
		if($showCopyright && $showLastUpdate)
		{ 
			?>
			<td id ="occuPlanFooter" colspan="32">
				<div id="showCopyrightFooter">
					<a href="http://www.belegungsplan-fewo.de/" title="Belegungsplan für Ihre Ferienwohnung">&#169; Belegungsplan FewoBepa</a>
				</div>
				<div id="showLastUpdateFooter">
					Letzte Aktualisierung: <?php echo date('d.m.Y', filemtime(dirname(__FILE__).'/../save-files/occupancy-data.csv')); ?>
				</div>
			</td>
			<?php 
		}
		elseif($showCopyright)
		{
			?>
			<td id ="occuPlanFooter" colspan="32">
				<div id="showCopyrightFooter">
					<a href="http://www.belegungsplan-fewo.de/" title="Belegungsplan für Ihre Ferienwohnung">&#169; Belegungsplan FewoBepa</a>
				</div>
			</td>
			<?php 
		}
		elseif($showLastUpdate)
		{
			?>
			<td id ="occuPlanFooter" colspan="32">
				<div id="showLastUpdateFooter">
					Letzte Aktualisierung: <?php echo date('d.m.Y', filemtime(dirname(__FILE__).'/../save-files/occupancy-data.csv')); ?>
				</div>
			</td>
			<?php 
		}
		if($showCopyright || $showLastUpdate)
		{
			?>
			</tr>
			<?php
		} 
	}
	
	/**
	 * Creates the occupancy plan date row.
	 * 
	 * @access public
	 * @static
	 * @param bool $isStartEndRow - indicator whether it is the start or end date row or not 
	 * @param int $repeatDateRowNumber - number after which number of months the date row appears again
	 * @param int $currentMonthToDisplay - current month number
	 * @param int $numberOfMonthsToDisplay - total number of months that are visible
     * @param bool $includeLastDate - whether last date shall be included
	 */
	public static function createDateRow($currentYearToDisplay, $isStartEndRow = true, $repeatDateRowNumber = null, $currentMonthToDisplay = null, $numberOfMonthsToDisplay = null, $includeLastDate = false)
	{
		if($isStartEndRow || ($repeatDateRowNumber !== 0 && $currentMonthToDisplay !== $numberOfMonthsToDisplay && $currentMonthToDisplay % $repeatDateRowNumber === 0))
		{
            if($isStartEndRow && $includeLastDate)
            { ?>
                <tr class="day startRow" id="<?php echo $currentMonthToDisplay.'-'.$currentYearToDisplay; ?>">
            <?php
            }
            else
            { ?>
                <tr class="day">
            <?php
            }?>
				<td class="year"><?php echo $currentYearToDisplay; ?></td>
				<?php 
				for($dayNum = 1; $dayNum <= DateTimeUtil::MAX_MONTH_DAY_NUM; $dayNum++)
				{ ?>
					<td><?php echo $dayNum; ?></td>
				<?php
				} ?>
			</tr>
		<?php
		}
	}

    /**
	 * Creates the occupancy plan table body.
	 *
	 * @access public
	 * @static
	 * @param int $currentMonthToDisplay - start month
	 * @param int $currentYearToDisplay - start year
	 */
    public static function createOccupancyPlan($currentMonthToDisplay, $currentYearToDisplay)
    {
        $occupancyPlan = OccupancyPlan::getInstance();
        $configuration = Configuration::getInstance();

        $numberOfMonthsToDisplay = $configuration->getNumberOfMonthsToDisplay();
        $repeatDateRowNumber = $configuration->getRepeatDateRowNumber();
        $showCopyright = $configuration->getShowCopyright();
        $showLastUpdate = $configuration->getShowLastUpdate();
        $useMonthShortcutNames = $configuration->getUseMonthShortcutNames();
        
        OccuPlanViewHelper::createDateRow($currentYearToDisplay, true, null, $currentMonthToDisplay, null, true);
        for($month = 1; $month <= $numberOfMonthsToDisplay; $month++)
        {
            if($currentMonthToDisplay === 13)
            {
                $currentMonthToDisplay = 1;
                $currentYearToDisplay += 1;
            }
            ?>
            <tr class="week">
            <td class="monthName">
            <?php
            $monthName = DateTimeUtil::getMonthName($currentMonthToDisplay, $useMonthShortcutNames);
            if(!$useMonthShortcutNames && $monthName === 'Maerz')
            {
                echo 'M&#228;rz';
            }
            else
            {
                echo $monthName;
            }
            ?>
            </td>
            <?php
            if($monthName === 'April' || $monthName === 'Apr' ||
                $monthName === 'Juni' || $monthName === 'Jun' ||
                $monthName === 'September' || $monthName === 'Sep' ||
                $monthName === 'November' || $monthName === 'Nov')
            {
                $monthDayNum = DateTimeUtil::MAX_MONTH_DAY_NUM - 1;
            }
            elseif($monthName === 'Februar' || $monthName === 'Feb')
            {
                if(($currentYearToDisplay % 400) === 0 ||
                   (($currentYearToDisplay % 4) === 0 && ($currentYearToDisplay % 100) != 0))
                {
                    $monthDayNum = DateTimeUtil::MAX_MONTH_DAY_NUM - 2;
                }
                else
                {
                    $monthDayNum = DateTimeUtil::MAX_MONTH_DAY_NUM - 3;
                }
            }
            else
            {
                $monthDayNum = DateTimeUtil::MAX_MONTH_DAY_NUM;
            }
            for($dayNum = 1; $dayNum <= 31; $dayNum++)
            {
                if($dayNum <= $monthDayNum)
                {
                    $curDateToDisplay = $dayNum.'.'.$currentMonthToDisplay.'.'.$currentYearToDisplay;
                    $curWeekdayShortcutName = DateTimeUtil::getWeekdayShortcutName($curDateToDisplay);
                    if($curWeekdayShortcutName === 'Sa' || $curWeekdayShortcutName === 'So')
                    {
                        ?>
                        <td class="weekend"><?php echo $curWeekdayShortcutName; ?></td>
                        <?php
                    }
                    else
                    {
                        ?>
                        <td><?php echo $curWeekdayShortcutName; ?></td>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <td class="noweek">&#160;</td>
                    <?php
                }
            } ?>
            </tr>
            <?php
            foreach($configuration->getApartmentNames() as $curApartment)
            {
                ?>
                <tr class="free">
                <td class="apartmentName"><?php echo str_replace('__', ' ', $curApartment); ?></td>
                <?php
                $dayNum = 1;
                for($p = 1; $p <= 31; $p++)
                {
                    if($p <= $monthDayNum)
                    {
                        $dayNum = str_pad($dayNum, 2, 0, STR_PAD_LEFT);
                        $cssId = trim($curApartment).$currentYearToDisplay.$currentMonthToDisplay.$dayNum++;
                        ?>
                        <td id="<?php echo $cssId ?>"<?php echo $occupancyPlan->getOccupancyDataById($cssId) ? ' class="'.$occupancyPlan->getOccupancyDataById($cssId).'"' : ''; ?>>&#160;</td>
                        <?php
                    }
                    else
                    {
                        ?>
                        <td class="noweek">&#160;</td>
                        <?php
                    }
                }
                ?>
                </tr>
                <?php
            }
			$tmpCurrentYearToDisplay = $currentYearToDisplay;
			if($currentMonthToDisplay === 12)
			{
					$tmpCurrentYearToDisplay += 1;
			}
            OccuPlanViewHelper::createDateRow($tmpCurrentYearToDisplay, false, $repeatDateRowNumber, $month, $numberOfMonthsToDisplay);
            $currentMonthToDisplay += 1;
        }
        OccuPlanViewHelper::createDateRow($currentYearToDisplay);
        OccuPlanViewHelper::createFooter($showCopyright, $showLastUpdate);
    }

    /**
	 * Creates the occupancy plan table body for the edit view.
	 *
	 * @access public
	 * @static
	 * @param int $currentMonthToDisplay - start month
	 * @param int $currentYearToDisplay - start year
	 */
    public static function createOccupancyPlanForEdit($currentMonthToDisplay, $currentYearToDisplay)
    {
        $occupancyPlan = OccupancyPlan::getInstance();
        $configuration = Configuration::getInstance();

        $numberOfMonthsToDisplay = $configuration->getNumberOfMonthsToDisplay();
        $repeatDateRowNumber = $configuration->getRepeatDateRowNumber();
        $showCopyright = $configuration->getShowCopyright();
        $showLastUpdate = $configuration->getShowLastUpdate();
        $useMonthShortcutNames = $configuration->getUseMonthShortcutNames();
        
        OccuPlanViewHelper::createDateRow($currentYearToDisplay, true, null, $currentMonthToDisplay, null, true);
        for($month = 1; $month <= $numberOfMonthsToDisplay; $month++)
        {
            if($currentMonthToDisplay === 13)
            {
                $currentMonthToDisplay = 1;
                $currentYearToDisplay += 1;
            }
        ?>
        <tr class="week">
            <td class="monthName">
            <?php
            $monthName = DateTimeUtil::getMonthName($currentMonthToDisplay, $useMonthShortcutNames);
            if(!$useMonthShortcutNames && $monthName === 'Maerz')
            {
                echo 'M&#228;rz';
            }
            else
            {
                echo $monthName;
            }
            ?>
            </td>
            <?php
            if($monthName === 'April' || $monthName === 'Apr' ||
                $monthName === 'Juni' || $monthName === 'Jun' ||
                $monthName === 'September' || $monthName === 'Sep' ||
                $monthName === 'November' || $monthName === 'Nov')
            {
                $monthDayNum = DateTimeUtil::MAX_MONTH_DAY_NUM - 1;
            }
            elseif($monthName === 'Februar' || $monthName === 'Feb')
            {
                if(($currentYearToDisplay % 400) === 0 ||
                   (($currentYearToDisplay % 4) === 0 && ($currentYearToDisplay % 100) != 0))
                {
                    $monthDayNum = DateTimeUtil::MAX_MONTH_DAY_NUM - 2;
                }
                else
                {
                    $monthDayNum = DateTimeUtil::MAX_MONTH_DAY_NUM - 3;
                }
            }
            else
            {
                $monthDayNum = DateTimeUtil::MAX_MONTH_DAY_NUM;
            }
            for($dayNum = 1; $dayNum <= 31; $dayNum++)
            {
                if($dayNum <= $monthDayNum)
                {
                    $curDateToDisplay = $dayNum.'.'.$currentMonthToDisplay.'.'.$currentYearToDisplay;
                    $curWeekdayShortcutName = DateTimeUtil::getWeekdayShortcutName($curDateToDisplay);
                    if($curWeekdayShortcutName === 'Sa' || $curWeekdayShortcutName === 'So')
                    {
                        ?>
                        <td class="weekend"><?php echo $curWeekdayShortcutName; ?></td>
                        <?php
                    }
                    else
                    {
                        ?>
                        <td><?php echo $curWeekdayShortcutName; ?></td>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <td class="noweek">&#160;</td>
                    <?php
                }
            } ?>
            </tr>
            <?php
            foreach($configuration->getApartmentNames() as $curApartment)
            {
                ?>
                <tr class="free">
                <td class="apartmentName"><?php echo str_replace('__', ' ', $curApartment); ?></td>
                <?php
                $dayNum = 1;
                for($p = 1; $p <= 31; $p++)
                {
                    if($p <= $monthDayNum)
                    {
                        $dayNum = str_pad($dayNum, 2, 0, STR_PAD_LEFT);
                        $cssId = trim($curApartment).$currentYearToDisplay.$currentMonthToDisplay.$dayNum++;
                        EditOccuPlanHelper::createCheckboxColumn($cssId, $occupancyPlan);
                    }
                    else
                    {
                        ?>
                        <td class="noweek">&#160;</td>
                        <?php
                    }
                }
                ?>
                </tr>
                <?php
            }
			$tmpCurrentYearToDisplay = $currentYearToDisplay;
			if($currentMonthToDisplay === 12)
			{
					$tmpCurrentYearToDisplay += 1;
			}
            OccuPlanViewHelper::createDateRow($tmpCurrentYearToDisplay, false, $repeatDateRowNumber, $month, $numberOfMonthsToDisplay);
            $currentMonthToDisplay += 1;
        }
        OccuPlanViewHelper::createDateRow($currentYearToDisplay);
        OccuPlanViewHelper::createFooter($showCopyright, $showLastUpdate);
    }
}
?>