<?php
/**
 * View that offers the interface to edit the general settings of the occupancy plan application.
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
$apartmentNames = $configuration->getApartmentNames();
$homeLink = $configuration->getHomeLink();
$numberOfMonthsToDisplay = $configuration->getNumberOfMonthsToDisplay();
$repeatDateRowNumber = $configuration->getRepeatDateRowNumber();
$showAdminLink = $configuration->getShowAdminLink();
$showCopyright = $configuration->getShowCopyright();
$showLastUpdate = $configuration->getShowLastUpdate();
$startMonth = $configuration->getStartMonth();
$useMonthShortcutNames = $configuration->getUseMonthShortcutNames();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta charset="utf-8" />
<title>Allgemeine Einstellungen - Belegungsplan FewoBepa - Admin-Bereich</title>
<meta name="description" content="Hier werden allgemeine Einstellungen des Belegungsplan FewoBepa vorgenommen." />
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
		<h2>Allgemeine Einstellungen</h2>
		<form action="../helper-files/settingsFormHelper.php" method="post">
			<div id="settingsTableWrapper">
				<table id="settingsTable">
					<tr class="settingsTopRow">
						<td><strong>FeWo Anzahl &amp; Name</strong></td>
						<td class="settingsTopColInfo"><img src="../image-files/information.png" width="16" height="16" alt="Geben Sie hier die Anzahl und die Namen Ihrer Ferienwohnungen an." title="Geben Sie hier die Anzahl und die Namen Ihrer Ferienwohnungen an." /></td>
						<td><strong>Anzahl</strong></td>
						<td id="settingsTopCol4"><strong>Name</strong></td>
					</tr>
					<tr>
						<td></td><td></td>
						<td class="textAlignRight">
							<select id="numOfApartmentsSelect" name="numOfApartmentsSelect">
								<?php SettingsHelper::checkSelectStatusById(SettingsHelper::APARTMENT_NAMES, $apartmentNames); ?>
							</select>
						</td>
						<td>
							<div id="apartmentNames">
								<?php SettingsHelper::createApartmentNameTextfields($apartmentNames); ?>
							</div>
						</td>
					</tr>
					<tr class="settingsTopRow">
						<td><strong>Monatsanzahl</strong></td>
						<td class="settingsTopColInfo"><img src="../image-files/information.png" width="16" height="16" alt="Geben Sie hier die Anzahl der anzuzeigenden Monate des Belegungsplans an." title="Geben Sie hier die Anzahl der anzuzeigenden Monate des Belegungsplans an." /></td>
						<td><strong>Anzahl</strong></td>
						<td></td>
					</tr>
					<tr>
						<td></td><td></td>
						<td class="textAlignRight">
							<select name="numOfMonthsSelect">
								<?php SettingsHelper::checkSelectStatusById(SettingsHelper::NUMBER_OF_MONTHS_TO_DISPLAY, $numberOfMonthsToDisplay); ?>
							</select>
						</td><td></td>
					</tr>
					<tr class="settingsTopRow">
						<td><strong>Startmonat</strong></td>
						<td class="settingsTopColInfo"><img src="../image-files/information.png" width="16" height="16" alt="Geben Sie hier den Startmonat an." title="Geben Sie hier den Startmonat an." /></td>
						<td><strong>Anzeigen</strong></td>
						<td></td>
					</tr>
					<tr>
						<td></td><td></td>
						<td class="textAlignRight">
							<select name="startMonthSelect">
								<?php SettingsHelper::checkSelectStatusById(SettingsHelper::START_MONTH, $startMonth); ?>
							</select>
						</td><td></td>
					</tr>
					<tr class="settingsTopRow">
						<td><strong>Datumszeile</strong></td>
						<td class="settingsTopColInfo"><img src="../image-files/information.png" width="16" height="16" alt="Geben Sie hier an, ob und wie die Datumszeile angezeigt wird." title="Geben Sie hier an, ob und wie die Datumszeile angezeigt wird." /></td>
						<td><strong>Anzeigen</strong></td>
						<td></td>
					</tr>
					<tr>
						<td></td><td></td>
						<td class="textAlignRight">
							<select name="repeatDateRowNumberSelect">
								<?php SettingsHelper::checkSelectStatusById(SettingsHelper::REPEAT_DATE_ROW_NUMBER, $repeatDateRowNumber); ?>
							</select>
						</td><td></td>
					</tr>
					<tr class="settingsTopRow">
						<td><strong>Home-Link</strong></td>
						<td class="settingsTopColInfo"><img src="../image-files/information.png" width="16" height="16" alt="Hier können Sie einen Link angeben, der Sie z.B. zurück zur Frontend-Ansicht Ihres Belegungsplans leitet. Dieser Link wird dann im Admin-Bereich oben rechts zu sehen sein." title="Hier können Sie einen Link angeben, der Sie z.B. zurück zur Frontend-Ansicht Ihres Belegungsplans leitet. Dieser Link wird dann im Admin-Bereich oben rechts zu sehen sein." /></td>
						<td><strong>Angeben</strong></td>
						<td></td>
					</tr>
					<tr>
						<td></td><td></td>
						<td class="textAlignRight">
							<?php SettingsHelper::createTextfieldById(SettingsHelper::HOME_LINK, $homeLink); ?>
						</td><td></td>
					</tr>
					<tr class="settingsTopRow">
						<td><strong>Monatsnamen als Abk.</strong></td>
						<td class="settingsTopColInfo"><img src="../image-files/information.png" width="16" height="16" alt="Geben Sie hier an, ob die Monatsnamen abgekürzt werden sollen." title="Geben Sie hier an, ob die Monatsnamen abgekürzt werden sollen." /></td>
						<td><strong>Anzeigen</strong></td>
						<td></td>
					</tr>
					<tr>
						<td></td><td></td>
						<td class="textAlignRight">
							Ja <input<?php echo $useMonthShortcutNames ? ' checked="checked"' : ''; ?> type="checkbox" id="useMonthShortcutNames" name="useMonthShortcutNames" value="1" />
						</td><td></td>
					</tr>
					<tr class="settingsTopRow">
						<td><strong>Admin-Bereich-Link</strong></td>
						<td class="settingsTopColInfo"><img src="../image-files/information.png" width="16" height="16" alt="Geben Sie hier an, ob der Admin-Bereich-Link im Frontend in der Legende erscheint." title="Geben Sie hier an, ob der Admin-Bereich-Link im Frontend in der Legende erscheint." /></td>
						<td><strong>Anzeigen</strong></td>
						<td></td>
					</tr>
					<tr>
						<td></td><td></td>
						<td class="textAlignRight">
							Ja <input<?php echo $showAdminLink ? ' checked="checked"' : ''; ?> type="checkbox" id="showAdminLink" name="showAdminLink" value="1" />
						</td><td></td>
					</tr>
					<tr class="settingsTopRow">
						<td><strong>Aktualisierungsdatum</strong></td>
						<td class="settingsTopColInfo"><img src="../image-files/information.png" width="16" height="16" alt="Hier können Sie angeben, ob Sie das letzte Aktualisierungsdatum Ihres Belegungsplan anzeigen wollen." title="Hier können Sie angeben, ob Sie das letzte Aktualisierungsdatum Ihres Belegungsplan anzeigen wollen." /></td>
						<td><strong>Anzeigen</strong></td>
						<td></td>
					</tr>
					<tr>
						<td></td><td></td>
						<td class="textAlignRight">
							Ja <input<?php echo $showLastUpdate ? ' checked="checked"' : ''; ?> type="checkbox" id="showLastUpdate" name="showLastUpdate" value="1" />
						</td><td></td>
					</tr>
				</table>
				<input type="submit" id="settingsSubmit" name="settingsSubmit" value="Speichern" /><div id="errorMessage"></div>
			</div>
		</form>
	</article>
	<aside>
		<div class="wrap">
			<div class="title">
				Hinweis FeWo-Name
			</div>
			<div class="text">
				Vermeiden Sie Sonderzeichen, da zurzeit noch nicht für alle Sonderzeichen getestet
				wurde, ob diese korrekt verarbeitet werden und somit eventuell Probleme beim Speichern
				der Belegungsdaten auftreten können.
			</div>
		</div>
	</aside>
	<footer>
		<?php require_once('../include-files/footer.php'); ?>
	</footer>
</div>
<script type="text/javascript" src="../js-files/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js-files/settings.js"></script>
</body>
</html>