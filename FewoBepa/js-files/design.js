/**
 * JavaScript functions providing validation support for the design view.
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
 * keypress event for the submit button
 */
$(document).ready(function() 
{
	eventList = new Array('change', 'keyup');
	addEventListener('ApartmentName', eventList);
	addEventListener('Day', eventList);
	addEventListener('FontApartmentName', eventList);
	addEventListener('FontDay', eventList);
	addEventListener('FontFooterInformations', eventList);
	addEventListener('FontMonth', eventList);
	addEventListener('FontWeekday', eventList);
	addEventListener('FontYear', eventList);
	addEventListener('FooterInformations', eventList);
	addEventListener('Month', eventList);
	addEventListener('OccuPlanTable', eventList);
	addEventListener('Weekend', eventList);
	addEventListener('Year', eventList);
	addEventListener('DayTypeOccupied', eventList);
	addEventListener('DayTypeFree', eventList);
	addEventListener('DayTypeNotToOccupy', eventList);
	addEventListener('BorderOccuPlanTable', eventList);

	$('#designSubmit').click(function()
	{
		return submitEventFired();
	});
	$('#designSubmit').keypress(function()
	{
		return submitEventFired();
	});
});

/**
 * Binds the given events on the given id.
 * 
 * @param string id - id of the current colour option
 * @param array eventList - contains the events
 */
function addEventListener(id, eventList)
{
	if(is_array(eventList) && eventList.length == 2)
	{
		$('#'+id+'Select').bind(eventList[0], function() 
		{
			selectChanged(id);
		});
		$('#'+id+'Code').bind(eventList[1], function()
		{
			codeChanged(id);
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
		$('#errorMessage').css('margin', '12px 0 0 0');
		$('#designSubmit').css('float', 'left');
		$('#designSubmit').css('margin-right', '10px');
		return false;
	}
}

/**
 * Triggered when selected colour select list option changed and clears the colour code
 * textfield if the selected option is not "Farbcode".
 * 
 * @param string id - id of the current colour option
 */
function selectChanged(id)
{
	if($('#'+id+'Select option:selected').val() != 'colourCodeUsed')
	{
		$('#'+id+'Code').val("");
		$('#'+id+'Select').css('background-color', $('#'+id+'Select option:selected').val());
		$('#'+id+'Select option:selected').html('&nbsp;');
		errorsObject[id] = null;
		setAcceptImage(id);
	}
	else
	{
		$('#'+id+'Select').css('background-color', '#fff');
		$('#'+id+'Code').trigger('keyup');
	}
}

/**
 * Triggered when colour code textfield content changed and validates the input of the user.
 * 
 * @param string id - id of the current colour option
 */
function codeChanged(id)
{
	if($('#'+id+'Select option:selected').val() != 'colourCodeUsed')
	{
		$('#'+id+'Select').val('colourCodeUsed');
		$('#'+id+'Select').css('background-color', '#fff');
	}
	if($('#'+id+'Code').val() === '')
	{
		setCancelImage(id, 'Farbcode darf nicht ausgewählt und gleichzeitig leer sein');
		errorsObject[id] = true;
	}
	else if(!$('#'+id+'Code').val().match(/^#([\d|[abcdefABCDEF]{6})$/))
	{
		setCancelImage(id, 'Farbcode muss das Format \'#123456\' haben');
		errorsObject[id] = true;
	}
	else
	{
		setAcceptImage(id);
		errorsObject[id] = null;
	}
}

/**
 * Sets the accept image.
 * 
 * @param string id - id of the current colour option
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
 * @param string id - id of the current colour option
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