<?php
/**
 * View for the authentication creating process of the admin control panel.
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
Authentication::ensureLogin(Authentication::VIEW_CREATE_LOGIN);
$username = !empty($_POST['username']) ? $_POST['username'] : '';
$password = !empty($_POST['password']) ? $_POST['password'] : '';
$repeatPassword = !empty($_POST['repeatPassword']) ? $_POST['repeatPassword'] : '';
if(isset($_POST['createLoginSubmit']))
{
	Authentication::createLogin($username, $password, $repeatPassword);
	if(Authentication::hasErrors())
	{
		$errors = Authentication::getErrors();
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta charset="utf-8" />
<title>Login-Daten erstellen - Belegungsplan FewoBepa - Admin-Bereich</title>
<meta name="description" content="Hiermit erstellen Sie als erstes einen Passwortschutz für den Admin-Bereich des Belegungsplans." />
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
		<?php require_once('../include-files/header.php'); ?>
	</header>
	<article>
		<h2>Login-Daten für den Admin-Bereich erstellen</h2>
		<form action="../view-admin-files/createLogin.php" method="post" id="loginForm">
			<fieldset>
				<legend>Login-Daten</legend>
				<label for="username">Benutzername:</label>
				<input type="text" id="username" name="username" size="20" maxlength="120" value="<?php echo $username; ?>" />
				<img src="../image-files/cancel.png" id="usernameImg" alt="Bitte geben Sie einen Benutzernamen an." title="Bitte geben Sie einen Benutzernamen an." width="16" height="16" />
				<label for="password">Passwort:</label>
				<input type="password" id="password" name="password" size="20" maxlength="120" value="<?php echo $password; ?>" />
				<img src="../image-files/cancel.png" id="passwordImg" alt="Bitte geben Sie ein Passwort an." title="Bitte geben Sie ein Passwort an." width="16" height="16" /><br />
				<label for="repeatPassword">Passwort wiederholen:</label>
				<input type="password" id="repeatPassword" name="repeatPassword" size="20" maxlength="120" value="<?php echo $repeatPassword; ?>" />
				<img src="../image-files/cancel.png" id="repeatPasswordImg" alt="Bitte wiederholen Sie das Passwort." title="Bitte wiederholen Sie das Passwort." width="16" height="16" />
			</fieldset>
			<fieldset>
				<legend>Login-Erstellung</legend>
				<input type="submit" id="createLoginSubmit" name="createLoginSubmit" value="Login einrichten" />
				<div id="errorMessage"></div>
			</fieldset>
		</form>
		<?php
			if(!empty($errors) && is_array($errors))
			{
				echo '<div id="loginErrors">';
				foreach($errors as $error)
				{
					echo $error.'<br />';
				}
				echo '</div>';
			}
		?>
	</article>
	<aside>
		<div class="wrap">
			<div class="title">
				Hinweis Benutzername
			</div>
			<div class="text">
				Der Benutzername muss aus mindestens 3 Zeichen bestehen.
			</div>
		</div>
		<div class="wrap ext">
			<div class="title">
				Hinweis Passwort
			</div>
			<div class="text">
				Das Passwort muss aus mindestens 3 Zeichen bestehen. Es wäre jedoch ratsam ein Passwort mit
				mindestens 8 Zeichen zu wählen. 
			</div>
		</div>
	</aside>
	<footer>
		<?php require_once('../include-files/footer.php'); ?>
	</footer>
</div>
<script type="text/javascript" src="../js-files/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js-files/authentication.js"></script>
</body>
</html>