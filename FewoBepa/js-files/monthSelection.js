/**
 * JavaScript functions providing functionality for the month selection.
 *
 * JavaScript version 1.8 & jQuery 1.5
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Called when website is ready and binds the month selection links.
 */
$(document).ready(function()
{
    var backward = 1;
    var forward = 2;

    $('#b1Months').bind('click', function()
    {
        sendMonthSelectionRequest(backward, 1);
        return false;
    });
    $('#b3Months').bind('click', function()
    {
        sendMonthSelectionRequest(backward, 3);
        return false;
    });
    $('#f1Months').bind('click', function()
    {
        sendMonthSelectionRequest(forward, 1);
        return false;
    });
    $('#f3Months').bind('click', function()
    {
        sendMonthSelectionRequest(forward, 3);
        return false;
    });
});

/**
 * Sends ajax request for month selection and manages the response.
 * 
 * @param int type - whether forward or backward
 * @param int numOfMonths - number of months
 */
function sendMonthSelectionRequest(type, numOfMonths)
{
    var lastDate = $('.startRow').attr('id').split('-');
    if(lastDate.length === 2)
    {
        var isAdmin = false;
        var isAdminPreview = true;
        var url = window.location.href;

        if(url.indexOf('editOccuPlan.php') !== -1)
        {
            isAdminPreview = false;
        }

        if(url.indexOf('FewoBepa/') !== -1)
        {
            url = '../helper-files/monthSelectionHelper.php';
            isAdmin = true;
        }
        else
        {
            url = 'FewoBepa/helper-files/monthSelectionHelper.php';
        }
        $.post(
            url,
            {
                editIdentifier: 'editMonthSelectionAjax',
                type: type,
                numOfMonths: numOfMonths,
                month: lastDate[0],
                year: lastDate[1],
                isAdmin: isAdmin,
                isAdminPreview: isAdminPreview
            },
            function(data) {
                var dataArray = data.split(':::');
                if(dataArray.length === 2)
                {
                    $('#occuPlanTable tr').remove();
                    $('#occuPlanTable').append(dataArray[0]);

                    if(isAdmin && !isAdminPreview)
                    {
                        bindCheckboxes();
                    }

                    $('#b3Months').css('background-position', '0 -39px');
                    $('#b3Months').css('cursor', 'pointer');
                    $('#b1Months').css('background-position', '0 -26px');
                    $('#b1Months').css('cursor', 'pointer');
                    $('#f3Months').css('background-position', '0 -91px');
                    $('#f3Months').css('cursor', 'pointer');
                    $('#f1Months').css('background-position', '0 -78px');
                    $('#f1Months').css('cursor', 'pointer');

                    if(dataArray[1] === 'backwardEnd')
                    {
                        $('#b3Months').css('background-position', '0 0');
                        $('#b3Months').css('cursor', 'default');
                        $('#b1Months').css('background-position', '0 -13px');
                        $('#b1Months').css('cursor', 'default');
                    }
                    else if(dataArray[1] === 'forwardEnd')
                    {
                        $('#f3Months').css('background-position', '0 -52px');
                        $('#f3Months').css('cursor', 'default');
                        $('#f1Months').css('background-position', '0 -65px');
                        $('#f1Months').css('cursor', 'default');
                    }
                }
            }
        );
    }
}