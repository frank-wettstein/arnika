<?php
/**
 * View for editing the design of the occupancy plan.
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
$colours = $configuration->getColours();
$colourTypes = $configuration->getColourTypes();
$fontFamily = $configuration->getFontFamily();
$fontSize = $configuration->getFontSize();
$homeLink = $configuration->getHomeLink();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta charset="utf-8" />
<title>Design bearbeiten - Belegungsplan FewoBepa - Admin-Bereich</title>
<meta name="description" content="Hier können Sie das Design des Belegungsplans bearbeiten und Ihn so individuell an Ihre Website anpassen." />
<meta name="keywords" content="Design bearbeiten, Belegungsplan, Admin-Bereich" />
<link rel="stylesheet" type="text/css" href="../css-files/styles-admin.css" />
<link rel="shortcut icon" type="image/x-icon" href="../image-files/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="../js-files/ie-html5.js"></script>
<![if IE 7]><link rel="stylesheet" type="text/css" href="../css-files/styles-ie7.css" /><![endif]>
<![if IE 6]><link rel="stylesheet" type="text/css" href="../css-files/styles-ie6.css" /><![endif]>
<![endif]-->
</head>
<body>
<div id="wrapper">
	<header>
		<? include('../include-files/header.php'); ?>
	</header>
	<article>
		<h2>Design bearbeiten</h2>
		<form action="../helper-files/designFormHelper.php" method="post">
		<div id="designTableWrapper">
			<table id="designTable">
				<thead>
					<tr>
						<th id="designTopCol1"><strong>Hintergrundfarbe</strong></th>
						<th><strong>Farbliste</strong></th>
						<th id="designTopCol3"><strong>Farbcode</strong></th>
						<th><strong>aktuelle Farbe</strong></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Belegungsplan</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_ID_OCCU_PLAN_TABLE, $colours, $colourTypes); ?>
					</tr>
					<tr class="oddRow">
						<td>Jahreszahlen</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_ID_YEAR, $colours, $colourTypes); ?>
					</tr>
					<tr>
						<td>Tageszahlen</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_ID_DAY, $colours, $colourTypes); ?>
					</tr>
					<tr class="oddRow">
						<td>Monatsnamen</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_ID_MONTH, $colours, $colourTypes); ?>
					</tr>
					<tr>
						<td>Ferienwohnungen</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_ID_APARTMENT_NAME, $colours, $colourTypes); ?>
					</tr>
					<tr class="oddRow">
						<td>Wochenende</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_ID_WEEKEND, $colours, $colourTypes); ?>
					</tr>
					<tr>
						<td>Footer</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_ID_FOOTER_INFORMATIONS, $colours, $colourTypes); ?>
					</tr>
					<tr class="designTopRow">
						<td colspan="4"><strong>Schriftfarbe</strong></td>
					</tr>
					<tr>
						<td>Jahreszahlen</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_FONT_ID_YEAR, $colours, $colourTypes); ?>
					</tr>
					<tr class="oddRow">
						<td>Tageszahlen</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_FONT_ID_DAY, $colours, $colourTypes); ?>
					</tr>
					<tr>
						<td>Monatsnamen</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_FONT_ID_MONTH, $colours, $colourTypes); ?>
					</tr>
					<tr class="oddRow">
						<td>Ferienwohnungen</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_FONT_ID_APARTMENT_NAME, $colours, $colourTypes); ?>
					</tr>
					<tr>
						<td>Wochentag</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_FONT_ID_WEEKDAY, $colours, $colourTypes); ?>
					</tr>
					<tr class="oddRow">
						<td>Footer</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_FONT_ID_FOOTER_INFORMATIONS, $colours, $colourTypes); ?>
					</tr>
					<tr class="designTopRow">
						<td colspan="4"><strong>Tagestypfarbe</strong></td>
					</tr>
					<tr>
						<td>An- &amp; Abreise, Belegt</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_DAY_TYPE_ID_ARRIVAL_DEPARTURE_OCCUPIED, $colours, $colourTypes); ?>
					</tr>
					<tr>
						<td>Frei</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_DAY_TYPE_ID_FREE, $colours, $colourTypes); ?>
					</tr>
					<tr class="oddRow">
						<td>Nicht belegbar</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_DAY_TYPE_ID_NOT_TO_OCCUPY, $colours, $colourTypes); ?>
					</tr>
					<tr class="designTopRow">
						<td colspan="4"><strong>Rahmenfarbe</strong></td>
					</tr>
					<tr>
						<td>Belegungsplan</td>
						<?php DesignHelper::createColourColumnById(DesignHelper::COLOUR_BORDER_ID_OCCU_PLAN_TABLE, $colours, $colourTypes); ?>
					</tr>
					<tr class="designTopRow designTopRowCenter">
						<td><strong>Schrift</strong></td>
						<td><strong>Schriftgröße</strong></td>
						<td><strong>Schriftart</strong></td>
						<td><strong>aktuelle Schriftgröße &amp; Schriftart</strong></td>
					</tr>
					<tr>
						<td>Belegungsplan</td>
						<td>
							<select name="<?php echo DesignHelper::FONT_SIZE; ?>">
								<?php DesignHelper::createFontColumnById(DesignHelper::FONT_SIZE, $fontSize); ?>
							</select>
						</td>
						<td>
							<select name="<?php echo DesignHelper::FONT_FAMILY; ?>">
								<?php DesignHelper::createFontColumnById(DesignHelper::FONT_FAMILY, $fontFamily); ?>
							</select>
						</td>
						<td style="font-size:<?php echo $fontSize; ?>;font-family:<?php echo $fontFamily; ?>;font-weight:bold;">Beispieltext</td>
					</tr>
				</tbody>
	  		</table>
	  		<input id="designSubmit" type="submit" value="Änderungen speichern" /><div id="errorMessage"></div>
	  	</div>
  		</form>
	</article>
	<aside>
		<div class="wrap">
			<div class="title">
				Hinweis Farbauswahl
			</div>
			<div class="text">
				Es kann entweder eine vordefinierte Farbe aus der Farbliste gewählt werden oder
				es wird ein Farbcode in hexadezimaler Form angegeben.<br />
				Farbcode-Format: #123456
			</div>
		</div>
		<div class="wrap ext">
			<div class="title">
				Hinweis Schriftwahl
			</div>
			<div class="text">
				Die Einstellungen für die Schrift wirken sich nicht auf das Design des
				Belegungsplans im Admin-Bereich aus, sondern nur auf die Frontend-Ansicht.
			</div>
		</div>
	</aside>
	<footer>
		<?php require_once('../include-files/footer.php'); ?>
	</footer>
</div>
<script type="text/javascript" src="../js-files/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js-files/design.js"></script>
</body>
</html>