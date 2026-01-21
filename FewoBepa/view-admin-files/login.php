<?php
/**
 * View for the login of the admin control panel.
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
Authentication::ensureLogin(Authentication::VIEW_LOGIN);
$username = !empty($_POST['username']) ? $_POST['username'] : '';
$password = !empty($_POST['password']) ? $_POST['password'] : '';
if(isset($_POST['loginSubmit']))
{
	Authentication::login($username, $password);
	if(Authentication::hasErrors())
	{
		$errors = Authentication::getErrors();
	}
}
$configuration = Configuration::getInstance();
$homeLink = $configuration->getHomeLink();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta charset="utf-8" />
<title>Login - Belegungsplan FewoBepa - Admin-Bereich</title>
<meta name="description" content="Hier können Sie sich in den Admin-Bereich des Belegungsplan einloggen." />
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
		<h2>Login für den Admin-Bereich</h2>
		<form action="../view-admin-files/login.php" method="post" id="loginForm">
			<fieldset>
				<legend>Login-Daten</legend>
				<label for="username">Benutzername:</label>
				<input type="text" id="username" name="username" size="20" maxlength="120" value="<?php echo $username; ?>" />
				<label for="password">Passwort:</label>
				<input type="password" id="password" name="password" size="20" maxlength="120" value="<?php echo $password; ?>" />
			</fieldset>
			<fieldset>
				<legend>Login</legend>
				<input type="submit" id="loginSubmit" name="loginSubmit" value="Anmelden" /><div id="errorMessage"></div>
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
				Hinweis
			</div>
			<div class="text">
				Geben Sie Ihre Zugangsdaten hier an, um sich in den Admin-Bereich einzuloggen.
			</div>
		</div>
	</aside>
	<footer>
		<?php require_once('../include-files/footer.php'); ?>
	</footer>
</div>
</body>
</html>