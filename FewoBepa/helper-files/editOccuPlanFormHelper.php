<?php
/**
 * EditOccuPlanFormHelper
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
if(isset($_POST['editIdentifier']) && $_POST['editIdentifier'] === 'editOccuPlanAjax')
{
	EditOccuPlanHelper::handleAjaxRequest();	
}
else 
{
	EditOccuPlanHelper::handleFormSubmit();
}
?>