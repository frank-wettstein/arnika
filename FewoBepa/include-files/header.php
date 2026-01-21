<?php
/**
 * Header with navigation
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */
?>
<h1>FewoBepa - Admin-Bereich<span>Belegungsplan</span></h1>
<div id="hnav">
	<?php if(!empty($homeLink)) { ?>
		<a href="<?php echo $homeLink; ?>" title="Home">Home</a>
	<? } ?>
	<a href="http://www.belegungsplan-fewo.de/kontakt.php" title="Kontaktaufnahme bei Fragen und/oder Problemen">Kontakt</a>
	<a href="http://www.belegungsplan-fewo.de/" title="FewoBepa Belegungsplan-Website">FewoBepa-Website</a>
</div>
<nav>
	<ul>
		<li><a href="admin.php" title="Admin-Startseite">Admin-Startseite</a></li>
		<li><a href="preview.php" title="Vorschau des Belegungsplans">Vorschau</a></li>
		<li><a href="editOccuPlan.php" title="Belegungsplan bearbeiten">Belegungsplan bearbeiten</a></li>
		<li><a href="design.php" title="Design des Belegungsplans bearbeiten">Design bearbeiten</a></li>
		<li><a href="settings.php" title="Allgemeine Einstellungen des Belegungsplans">Einstellungen</a></li>
	</ul>
</nav>
<?php
if(Session::check('username') && Session::check('password'))
{
?>
	<div id="logout">
		<form action="../helper-files/logoutFormHelper.php" method="post">
			<fieldset>
				<input type="submit" name="logoutSubmit" value="Abmelden" />
			</fieldset>
		</form>
	</div>
<?php
}
?>
