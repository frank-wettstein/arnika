<?php
/**
 * Frontend include view file - the occupancy plan view for the frontend.
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

// includes autoloader file
require_once('FewoBepa/helper-files/autoloadHelper.php');
$configuration = Configuration::getInstance();
$showAdminLink = $configuration->getShowAdminLink();
$startMonth = $configuration->getStartMonth();
$currentYearToDisplay = DateTimeUtil::getCurrentYear();
$currentMonthToDisplay = DateTimeUtil::getCurrentMonth();

for($i = $startMonth - 1; $i > 0; $i--)
{
	$currentMonthToDisplay -= 1;
	if($currentMonthToDisplay === 0)
	{
		$currentMonthToDisplay = 12;
		$currentYearToDisplay -= 1;
	}
}
?>
<div id="occuPlanWrapper">
	<div id="occuPlanLegend">
		<div><img src="FewoBepa/image-files/arrival.png<?php echo '?update='.filemtime('FewoBepa/image-files/arrival.png'); ?>" width="12" height="12" alt="Anreise" />Anreise</div>
		<div><img src="FewoBepa/image-files/departure.png<?php echo '?update='.filemtime('FewoBepa/image-files/departure.png'); ?>" width="12" height="12" alt="Abreise" />Abreise</div>
		<div><img src="FewoBepa/image-files/arrivalDeparture.png<?php echo '?update='.filemtime('FewoBepa/image-files/arrivalDeparture.png'); ?>" width="12" height="12" alt="Ab- &amp; Abreise" />Ab- &amp; Anreise</div>
		<div><div id="legendOccupied"></div>Belegt</div>
		<div><div id="legendNotToOccupy"></div>Nicht belegbar</div>
		<?php
		if(!empty($showAdminLink))
		{ ?>
			<div><img src="FewoBepa/image-files/acp-image.png" width="12" height="12" alt="Admin-Bereich" />
			<a href="FewoBepa/view-admin-files/login.php" title="Admin-Bereich Belegungsplan">Admin-Bereich</a></div>
		<?php } ?>
        <div id="monthSelection">
            <a id="b3Months" href="" title="3 Monate zurück"></a>
            <a id="b1Months" href="" title="1 Monat zurück"></a>
            <a id="f1Months" href="" title="1 Monat vor"></a>
            <a id="f3Months" href="" title="3 Monate vor"></a>
        </div>
	</div>
<table id="occuPlanTable">
	<?php 
        OccuPlanViewHelper::createOccupancyPlan($currentMonthToDisplay, $currentYearToDisplay);
	?>
</table>
</div>