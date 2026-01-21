<?php
/**
 * Class EditOccuPlanHelper
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class with helper methods for the edit occu plan view.
 */
class EditOccuPlanHelper
{
	/**
	 * Creates checkbox columns for the given id.
	 * 
	 * @access public
	 * @static
	 * @param string $id - occupancy data id
	 * @param OccupancyPlan $occupancyPlan
	 */
	public static function createCheckboxColumn($id, OccupancyPlan $occupancyPlan)
	{
		?>
		<td id="<?php echo $id.'-td' ?>"<?php echo $occupancyPlan->getOccupancyDataById($id) ? ' class="'.$occupancyPlan->getOccupancyDataById($id).'"' : ''; ?>><input<?php echo $occupancyPlan->getOccupancyDataById($id) ? ' checked="checked"' : ''; ?> type="checkbox" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $id; ?>" /></td>
		<?php
	}
	
	/**
	 * Handles ajax requests and updates the occupancy plan data.
	 * 
	 * @access public
	 * @static
	 */
	public static function handleAjaxRequest()
	{
		if(!empty($_POST['id']) && !empty($_POST['dayType']))
		{
			if(Session::check('OccupancyPlan') && Session::read('OccupancyPlan'))
			{
				$occupancyPlan = Session::read('OccupancyPlan');	
			}
			$occupancyPlan->setOccupancyDataByIdAndDayType($_POST['id'], $_POST['dayType']);
		}	
	}
	
	/**
	 * Handles form submit and saves the occupancy plan data and forwards back to the edit occupancy plan
	 * view.
	 * 
	 * @access public
	 * @static
	 */
	public static function handleFormSubmit()
	{
		if(Session::check('OccupancyPlan') && Session::read('OccupancyPlan'))
		{
			$occupancyPlan = Session::read('OccupancyPlan');	
		}
		$occupancyPlan->saveOccupancyData();	
		header("location: ../view-admin-files/editOccuPlan.php");
		exit();
	}
}
?>