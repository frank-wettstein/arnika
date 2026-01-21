<?php
/**
 * View that shows a preview of the occupancy plan - in this view there are not any settings
 * which can be changed or set - the preview is just for the admin to see how the occupancy plan
 * looks like in the frontend for the vistors of the website.
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

// includes autoloader file
require_once('../helper-files/autoloadHelper.php');
Session::create();
Authentication::ensureLogin(Authentication::VIEW_NO_LOGIN);
$configuration = Configuration::getInstance();
$homeLink = $configuration->getHomeLink();
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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta charset="utf-8" />
<title>Vorschau - Belegungsplan FewoBepa - Admin-Bereich</title>
<meta name="description" content="Vorschau des Belegungsplan um den Belegungsplan so zu sehen, wie es Ihr Besucher im Frontend angezeigt wird." />
<link rel="stylesheet" type="text/css" href="../css-files/styles-admin.css" />
<link rel="stylesheet" type="text/css" href="../css-files/styles-admin-plan.css<?php echo '?update='.filemtime('../css-files/styles-admin-plan.css'); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="../image-files/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="../js-files/ie-html5.js"></script>
<![if IE 7]><link rel="stylesheet" type="text/css" href="../css-files/styles-ie7.css" /><![endif]>
<![if IE 6]><link rel="stylesheet" type="text/css" href="../css-files/styles-ie6.css" /><![endif]>
<![endif]-->
<style type="text/css">
.arrival{background:url('../image-files/arrival-acp.png<?php echo '?update='.filemtime('../image-files/arrival-acp.png'); ?>') no-repeat 0 0;}
.arrivalDeparture{background:url('../image-files/arrivalDeparture-acp.png<?php echo '?update='.filemtime('../image-files/arrivalDeparture-acp.png'); ?>') no-repeat 0 0;}
.departure{background:url('../image-files/departure-acp.png<?php echo '?update='.filemtime('../image-files/departure-acp.png'); ?>') no-repeat 0 0;}
</style>
</head>
<body>
<div id="wrapper">
	<header>
		<? include('../include-files/header.php'); ?>
	</header>
	<article>
		<h2>Vorschau Belegungsplan</h2>
		<div id="occuPlanWrapper">
			<div id="occuPlanLegend">
				<div><img src="../image-files/arrival-acp.png<?php echo '?update='.filemtime('../image-files/arrival-acp.png'); ?>" width="12" height="12" alt="Anreise" />Anreise</div>
				<div><img src="../image-files/departure-acp.png<?php echo '?update='.filemtime('../image-files/departure-acp.png'); ?>" width="12" height="12" alt="Abreise" />Abreise</div>
				<div><img src="../image-files/arrivalDeparture-acp.png<?php echo '?update='.filemtime('../image-files/arrivalDeparture-acp.png'); ?>" width="12" height="12" alt="Ab- &amp; Anreise" />Ab- &amp; Anreise</div>
				<div><div id="legendOccupied"></div>Belegt</div>
				<div><div id="legendNotToOccupy"></div>Nicht belegbar</div>
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
	</article>
	<aside>
		<div class="wrap">
			<div class="title">
				Vorschau-Info
			</div>
			<div class="text">
				Die Vorschau zeigt den Belegungsplan so, wie er auch im Frontend für die Besucher
				Ihrer Website aussieht.<br /><br />
				Jedoch wird die Standard-Schriftart und die 
				Standard-Schriftgröße im Admin-Bereich genutzt, da sonst das Layout des Admin-Bereichs
				"zerrissen" wird, wenn eine zu große Schriftart genutzt wird.<br /><br />
				Die Einstellung des Belegungsplans mit Ihrer individuell eingestellten Schriftgröße und
				Schriftart wird also nur im Frontend angewendet bzw. angezeigt.
			</div>
		</div>
	</aside>
	<footer>
		<?php require_once('../include-files/footer.php'); ?>
	</footer>
</div>
<script type="text/javascript" src="../js-files/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js-files/monthSelection.js"></script>
</body>
</html>