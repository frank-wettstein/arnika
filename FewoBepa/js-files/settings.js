/**
 * JavaScript functions providing validation support for the editSettings view.
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
 * @global array apartmentNames - includes the names of the apartments
 */
var apartmentNames = new Array();

$(document).ready(function() 
{
	addEventListener('numOfApartmentsSelect', new Array('change'));
	
	for(var numOfApp = 1; numOfApp <= 6; numOfApp++)
	{
		id = 'Apartment'+numOfApp;
		if(typeof($('#'+id).val()) !== 'undefined')
		{
			arrayKey = numOfApp - 1;
			apartmentNames[arrayKey] = $('#'+id).val();
		}
		errorsObject[id] = null;
	}
	
	$('#numOfApartmentsSelect').trigger('change');
			
	$('#settingsSubmit').click(function()
	{
		return submitEventFired();
	});
	$('#settingsSubmit').keypress(function()
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
		if(id === 'numOfApartmentsSelect')
		{
			$('#'+id).bind(eventList[0], function() 
			{
				selectChanged(id);
			});
		}
		else
		{
			$('#'+id).bind(eventList[0], function() 
			{
				textChanged(id);
			});
		}
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
		$('#errorMessage').css('margin', '12px 0 0 0');
		$('#settingsSubmit').css('float', 'left');
		$('#settingsSubmit').css('margin-right', '10px');
		return false;
	}
}

/**
 * Triggered when selected number of apartments select list option changed and
 * creates the apartment names textfields and initiates the addEventListener's.
 * 
 * @param string id - id of the number of apartments select list
 */
function selectChanged(id)
{
	for(var numOfApp = 1; numOfApp <= 6; numOfApp++)
	{
		arrayKey = 'Apartment'+numOfApp;
		errorsObject[arrayKey] = null;
	}
	
	numOfAppSelected = $('#'+id+' option:selected').val();
	$('#apartmentNames').html('');
	for(var numOfApp = 1; numOfApp <= numOfAppSelected; numOfApp++)
	{
		idTextfields = 'Apartment'+numOfApp;
		arrayKey = numOfApp - 1;
		apartmentNames[arrayKey] = typeof(apartmentNames[arrayKey]) !== 'undefined' ? apartmentNames[arrayKey] : '';
		$('#apartmentNames').append('FeWo-Name: <input id="'+idTextfields+'" name="'+idTextfields+'" value="'+apartmentNames[arrayKey]+'" /><img src="../image-files/accept.png" id="'+idTextfields+'Img" alt="OK" title="OK" /><br />');
		
		addEventListener(idTextfields, new Array('keyup'));
		$('#'+idTextfields).trigger('keyup');
	}
}

/**
 * Triggered when apartment name textfields content changed and validates 
 * the input of the user.
 * 
 * @param string id - id of the current textfield
 */
function textChanged(id)
{
	//gets the last sign of the string - in this case it's always a number
	arrayKey = $('#'+id).attr('id').substr($('#'+id).attr('id').length-1, 1);
	arrayKey = arrayKey - 1;
	apartmentNames[arrayKey] = $('#'+id).val();
	if($('#'+id).val() === '')
	{
		errorsObject[id] = true;
		setCancelImage(id, 'Bitte geben Sie einen FeWo-Namen an.');
	}
	else
	{
		errorsObject[id] = null;
		setAcceptImage(id);
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