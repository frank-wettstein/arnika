/**
 * JavaScript functions providing ajax functions for the editOccuPlan view.
 *
 * JavaScript version 1.8 & jQuery 1.5
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Called when website is ready and binds all checkboxes for click events.
 */
$(document).ready(function()
{
	bindCheckboxes();
});

/**
 * Binds all checkboxes for click events.
 */
function bindCheckboxes()
{
    $(":input:checkbox").bind('click', function()
	{
		checkboxClicked($(this).attr('id'));
	});
}

/**
 * Sets the right day type image for the clicked day and saves the data via ajax request.
 * 
 * @param string id - id of the checkbox that got clicked
 */
function checkboxClicked(id)
{
	var dayType = $("input:radio[name=dayType]:checked").val();
	if($('#'+id).attr('checked') === 'checked')
	{
		if(dayType === 'arrival')
		{
			$('#'+id+'-td').addClass('arrival');
		}
		else if(dayType === 'arrivalDeparture')
		{
			$('#'+id+'-td').addClass('arrivalDeparture');
		}
		else if(dayType === 'departure')
		{
			$('#'+id+'-td').addClass('departure');
		}
		else if(dayType === 'occupied')
		{
			$('#'+id+'-td').addClass('occupied');
		}
		else if(dayType === 'notToOccupy')
		{
			$('#'+id+'-td').addClass('notToOccupy');
		}
	}
	else
	{
		dayType = null;
		
		if($('#'+id+'-td').is('.arrival'))
		{
			$('#'+id+'-td').removeClass('arrival');
		}
		else if($('#'+id+'-td').is('.arrivalDeparture'))
		{
			$('#'+id+'-td').removeClass('arrivalDeparture');
		}
		else if($('#'+id+'-td').is('.departure'))
		{
			$('#'+id+'-td').removeClass('departure');
		}
		else if($('#'+id+'-td').is('.occupied'))
		{
			$('#'+id+'-td').removeClass('occupied');
		}
		else if($('#'+id+'-td').is('.notToOccupy'))
		{
			$('#'+id+'-td').removeClass('notToOccupy');
		}
	}
	$.post(
		'../helper-files/editOccuPlanFormHelper.php',
		{
			editIdentifier: 'editOccuPlanAjax',
			id: id, 
			dayType: dayType
		}
	);
}