<?php
/**
 * View for editing the occupancy plan.
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
$occupancyPlan = OccupancyPlan::getInstance();
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
Session::write('OccupancyPlan', $occupancyPlan);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta charset="utf-8" />
<title>Belegungsplan bearbeiten - Belegungsplan FewoBepa - Admin-Bereich</title>
<meta name="description" content="Hier kann der Belegungsplan FewoBepa bearbeitet werden und Anreise, Abreise, belegte Tage usw. eingestellt werden." />
<link rel="shortcut icon" type="image/x-icon" href="../image-files/favicon.ico" />
<link rel="stylesheet" type="text/css" href="../css-files/styles-admin.css" />
<link rel="stylesheet" type="text/css" href="../css-files/styles-admin-plan.css<?php echo '?update='.filemtime('../css-files/styles-admin-plan.css'); ?>" />
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
		<h2>Belegungsplan bearbeiten</h2>
		<form action="../helper-files/editOccuPlanFormHelper.php" method="post">
		<div id="occuPlanWrapper">
			<div id="occuPlanLegend">
				<div><input type="radio" name="dayType" value="arrival" />
				<img src="../image-files/arrival-acp.png<?php echo '?update='.filemtime('../image-files/arrival-acp.png'); ?>" width="12" height="12" alt="Anreise" />Anreise</div>
				<div><input type="radio" name="dayType" value="departure" />
				<img src="../image-files/departure-acp.png<?php echo '?update='.filemtime('../image-files/departure-acp.png'); ?>" width="12" height="12" alt="Abreise" />Abreise</div>
				<div><input type="radio" name="dayType" value="arrivalDeparture" />
				<img src="../image-files/arrivalDeparture-acp.png<?php echo '?update='.filemtime('../image-files/arrivalDeparture-acp.png'); ?>" width="12" height="12" alt="Abreise &amp; Anreise" />Ab- &amp; Anreise</div>
				<div><input checked="checked" type="radio" name="dayType" value="occupied" /><div id="legendOccupied"></div>Belegt</div>
				<div><input type="radio" name="dayType" value="notToOccupy" /><div id="legendNotToOccupy"></div>Nicht belegbar</div>
			   <div id="monthSelection">
                   <a id="b3Months" href="" title="3 Monate zurück"></a>
                   <a id="b1Months" href="" title="1 Monat zurück"></a>
                   <a id="f1Months" href="" title="1 Monat vor"></a>
                   <a id="f3Months" href="" title="3 Monate vor"></a>
               </div>
            </div>
			<table id="occuPlanTable">
				<?php
                    if(Session::check('viewMonth') && Session::check('viewYear'))
                    {
                        $currentMonthToDisplay = Session::read('viewMonth');
                        $currentYearToDisplay = Session::read('viewYear');
                    }
                    OccuPlanViewHelper::createOccupancyPlanForEdit($currentMonthToDisplay, $currentYearToDisplay);
				?>
			</table>
	  		<input id="occuPlanSubmit" type="submit" value="Änderungen speichern" />
		</div>
		</form>
	</article>
	<aside>
		<div class="wrap">
			<div class="title">
				Hinweis
			</div>
			<div class="text">
				Über dem Belegungsplan befindet sich die Legende, wo Sie den Tagestyp einstellen können.
				Standardmäßig ist der Tagestyp "Belegt" eingestellt.<br /><br />
				Nachdem Ihr gewünschter Tagestyp eingestellt ist, klicken SIe einfach nur auf den
				entsprechenden Tag, den Sie belegen möchten bzw. für den Sie den gewählten Tagestyp
				setzen möchten. Anschließend klicken Sie nur noch auf Änderungen speichern und dann
				werden die Änderungen übernommen.
			</div>
		</div>
	</aside>
	<footer>
		<?php require_once('../include-files/footer.php'); ?>
	</footer>
</div>
<script type="text/javascript" src="../js-files/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js-files/editOccuPlan.js"></script>
<script type="text/javascript" src="../js-files/monthSelection.js"></script>
</body>
</html>