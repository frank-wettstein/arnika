<?php
/**
 * View which acts as homepage and gives an overview about the admin control panel.
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
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta charset="utf-8" />
<title>Admin-Startseite - Belegungsplan FewoBepa - Admin-Bereich</title>
<meta name="description" content="Startseite des Admin-Bereichs des Belegungsplans FewoBepa mit einleitenden Informationen." />
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
		<h2>Admin-Bereich - Belegungsplan FewoBepa</h2>
		<p>
			Hier im Admin-Bereich können Sie alle Einstellungen bezüglich des FewoBepa Belegungsplans vornehmen.
		</p>
		<p>
			Ein kurzer Überblick über die Funktionen des Admin-Bereichs:
		</p>
		<table id="adminTable">
			<colgroup>
				<col id="adminTableTopicCol" />
				<col />
			</colgroup>
			<thead>
			<tr>
				<th><strong>Funktion</strong></th>
				<th><strong>Beschreibung</strong></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><strong>Vorschau</strong></td>
				<td>
					Die Vorschau zeigt den Belegungsplan so an, wie dieser auch im Frontend, also für die
					Besucher Ihrer Website angezeigt wird.
				</td>
			</tr>
			<tr class="oddRow">
				<td><strong>Belegungsplan bearbeiten</strong></td>
				<td>
					Hier können Sie den Belegungsplan bearbeiten und einstellen, welche Tage
					Anreise, Abreise, Ab- &amp; Anreise, belegte oder aber auch nicht belegbare Tage sind.
				</td>
			</tr>
			<tr>
				<td><strong>Design bearbeiten</strong></td>
				<td>
					Das Design bzw. Aussehen des Belegungsplan kann hier nach Ihren individuellen
					Wünschen angepasst werden. Hierzu gehören die Farbeinstellungen als auch
					die Schrifteinstellungen.
				</td>
			</tr>
			<tr class="oddRow">
				<td><strong>Einstellungen</strong></td>
				<td>
					Unter diesem Menüpunkt befinden sich alle allgemeinen Einstellungen, wie z.B.
					die Einstellung der Anzahl der anzuzeigenden Ferienwohnungen und deren Namen.
					Eine weitere allgemeine Einstellungsmöglichkeit ist die Option das letzte
					Aktualisierungddatum anzuzeigen, damit Ihre Besucher wissen, ob die Belegdaten
					Ihres Belegungsplans aktuell sind oder nicht.
				</td>
			</tr>
			</tbody>
		</table>
		<p>
			In der rechten oberen Ecke des Admin-Bereichs finden Sie Links, die Sie direkt
			zu unserem Kontaktformular bzw. zu unserer Website leiten.
		</p>
	</article>
	<aside>
		<div class="wrap">
			<div class="title">
				FewoBepa
			</div>
			<div class="text">
				Schauen Sie doch auch öfters mal auf unserer FewoBepa
				<a href="http://www.belegungsplan-fewo.de/" title="Belegungsplan-Ferienwohnung Website">Belegungsplan-Website</a>
				vorbei und informieren Sie sich, ob nicht schon eine neuere Version verfügbar ist.
			</div>
		</div>
		<div class="wrap ext">
			<div class="title">
				Support
			</div>
			<div class="text">
				Bei Problemen, Fragen, Verbesserungswünschen etc. kontaktieren Sie uns
				einfach über unser
				<a href="http://www.belegungsplan-fewo.de/kontakt.php" title="Kontaktformular">Kontaktformular</a>.
			</div>
		</div>
	</aside>
	<footer>
		<?php require_once('../include-files/footer.php'); ?>
	</footer>
</div>
</body>
</html>