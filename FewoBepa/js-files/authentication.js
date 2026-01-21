/**
 * JavaScript functions providing validation support and creating loin data files 
 * for the login view.
 *
 * JavaScript version 1.8 & jQuery 1.5
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * @global object errorObject - used as hash-array for errors
 */
var errorsObject = new Object();

/**
 * Called when website is ready and initiates the addEventListener's and sets the click and
 * keypress event for the submit button.
 */
$(document).ready(function() 
{
	eventList = new Array('keyup');
	addEventListener('username', eventList);
	addEventListener('password', eventList);
	addEventListener('repeatPassword', eventList);
	
	errorsObject['username'] = true;
	errorsObject['password'] = true;
	errorsObject['repeatPassword'] = true;
	
	$('#repeatPassword').attr('disabled', 'true');
	
	$('#createLoginSubmit').click(function()
	{
		return submitEventFired();
	});
	$('#createLoginSubmit').keypress(function()
	{
		return submitEventFired();
	});
});

/**
 * Binds the given events on the given id.
 * 
 * @param string id - id of the to binding textfield
 * @param array eventList - contains the events
 */
function addEventListener(id, eventList)
{
	if(is_array(eventList) && eventList.length == 1)
	{
		$('#'+id).bind(eventList[0], function() 
		{
			textChanged(id);
		});
	}
}

/**
 * Checks whether there are errors in the errorsObject - if so the submit routine gets
 * stopped and sets an error message.
 * 
 * @returns bool - false if errorsObject is not empty
 */
function submitEventFired()
{
	var errorsObjectSize = 0;
	for(var key in errorsObject)
	{
		if(errorsObject[key] != null)
		{
			errorsObjectSize++;
		}
	}
	if(errorsObjectSize != 0)
	{
		$('#errorMessage').html('<strong>Bitte korrigieren Sie erst Ihre Eingabefehler.</strong>');
		$('#errorMessage').css('color', '#ff0000');
		$('#errorMessage').css('margin', '14px 0 0 0');
		$('#createLoginSubmit').css('float', 'left');
		$('#createLoginSubmit').css('margin-right', '10px');
		$('#authentication').css('width', '420px');
		return false;
	}
}

/**
 * Triggered when the username or password textfield content changed and validates 
 * the input of the user.
 * 
 * @param string id - id of the current textfield
 */
function textChanged(id)
{
	if($('#'+id).val() === '' || $('#'+id).val().length <= 2 && id !== 'repeatPassword')
	{
		errorMessage = '';
		if(id === 'username')
		{
			errorMessage = 'Der Benutzername darf nicht leer sein und muss aus min. 3 Zeichen bestehen.';
		}
		else if(id === 'password')
		{
			$('#repeatPassword').attr('disabled', 'true');
			$('#repeatPassword').val('');
			setCancelImage('repeatPassword', 'Bitte wiederholen Sie das Passwort.');
			errorMessage = 'Das Passwort darf nicht leer sein und muss aus min. 3 Zeichen bestehen.';
		}
		setCancelImage(id, errorMessage);
		errorsObject[id] = true;
	}
	else if(id === 'repeatPassword' && $('#'+id).val() !== $('#password').val())
	{
		errorMessage = 'Das Passwort muss mit dem oberen eingegebenen übereinstimmen.';
		if($('#'+id).val() === '')
		{
			errorMessage = 'Bitte wiederholen Sie das Passwort.';
		}
		setCancelImage(id, errorMessage);
		errorsObject[id] = true;
	}
	else 
	{
		if(id === 'password')
		{
			$('#repeatPassword').removeAttr('disabled');
			setCancelImage('repeatPassword', 'Bitte wiederholen Sie das Passwort.');
		}
		setAcceptImage(id);
		errorsObject[id] = null;
	}
}

/**
 * Sets the accept image.
 * 
 * @param string id - id of the current textfield
 */
function setAcceptImage(id)
{
	$('#'+id+'Img').attr('src', '../image-files/accept.png');
	$('#'+id+'Img').attr('alt', 'OK');
	$('#'+id+'Img').attr('title', 'OK');
}

/**
 * Sets the cancel image. 
 * 
 * @param string id - id of the current textfield
 * @param string errorMessage
 */
function setCancelImage(id, errorMessage)
{
	$('#'+id+'Img').attr('src', '../image-files/cancel.png');
	$('#'+id+'Img').attr('alt', errorMessage);
	$('#'+id+'Img').attr('title', errorMessage);
}

/**
 * Checks whether a given value is an array and returns the result.
 * 
 * @param unknown value - value being checked if it is an array
 * @returns bool - true if value is an array and false if not
 */
function is_array(value) 
{
	if (typeof value === 'object' && value && value instanceof Array) 
	{
		return true;
	}
	return false;
}