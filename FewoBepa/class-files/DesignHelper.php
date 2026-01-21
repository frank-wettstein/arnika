<?php
/**
 * Class DesignHelper
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class with helper methods for the design view.
 */
class DesignHelper
{
	/**
	 * Constants for the colour id's.
	 * 
	 * @access const
	 */
	const COLOUR_ID_APARTMENT_NAME = 'ApartmentName';
	const COLOUR_ID_DAY = 'Day';
	const COLOUR_ID_FOOTER_INFORMATIONS = 'FooterInformations';
	const COLOUR_ID_MONTH = 'Month';
	const COLOUR_ID_OCCU_PLAN_TABLE = 'OccuPlanTable';
	const COLOUR_ID_WEEKEND = 'Weekend';
	const COLOUR_ID_YEAR = 'Year';
	
	/**
	 * Constants for the colour font id's.
	 * 
	 * @access const
	 */
	const COLOUR_FONT_ID_APARTMENT_NAME = 'FontApartmentName';
	const COLOUR_FONT_ID_DAY = 'FontDay';
	const COLOUR_FONT_ID_FOOTER_INFORMATIONS = 'FontFooterInformations';
	const COLOUR_FONT_ID_MONTH = 'FontMonth';
	const COLOUR_FONT_ID_WEEKDAY = 'FontWeekday';
	const COLOUR_FONT_ID_YEAR = 'FontYear';
	
	/**
	 * Constants for the colour day type id's.
	 * 
	 * @access const
	 */
	const COLOUR_DAY_TYPE_ID_ARRIVAL_DEPARTURE_OCCUPIED = 'DayTypeOccupied';
	const COLOUR_DAY_TYPE_ID_FREE = 'DayTypeFree';
	const COLOUR_DAY_TYPE_ID_NOT_TO_OCCUPY = 'DayTypeNotToOccupy';
	
	/**
	 * Constants for the colour border id's.
	 * 
	 * @access const
	 */
	const COLOUR_BORDER_ID_OCCU_PLAN_TABLE = 'BorderOccuPlanTable';
	
	/**
	 * Constants for the colour types.
	 * 
	 * @access const
	 */
	const COLOUR_TYPE_CODE = 1;
	const COLOUR_TYPE_LIST = 2;
	
	/**
	 * Constants for the font id's.
	 * 
	 * @access const
	 */
	const FONT_FAMILY = 'FontFamily';
	const FONT_SIZE = 'FontSize';
	
	/**
	 * @access public
	 * @staticvar array $colourIdList - list of all colour id's
	 */
	public static $colourIdList = array(
		self::COLOUR_ID_APARTMENT_NAME,
		self::COLOUR_ID_DAY,
		self::COLOUR_ID_FOOTER_INFORMATIONS,
		self::COLOUR_ID_MONTH,
		self::COLOUR_ID_OCCU_PLAN_TABLE,
		self::COLOUR_ID_WEEKEND,
		self::COLOUR_ID_YEAR,
		
		self::COLOUR_FONT_ID_APARTMENT_NAME,
		self::COLOUR_FONT_ID_DAY,
		self::COLOUR_FONT_ID_FOOTER_INFORMATIONS,
		self::COLOUR_FONT_ID_MONTH,
		self::COLOUR_FONT_ID_WEEKDAY,
		self::COLOUR_FONT_ID_YEAR,
		
		self::COLOUR_DAY_TYPE_ID_ARRIVAL_DEPARTURE_OCCUPIED,
		self::COLOUR_DAY_TYPE_ID_FREE,
		self::COLOUR_DAY_TYPE_ID_NOT_TO_OCCUPY,
		
		self::COLOUR_BORDER_ID_OCCU_PLAN_TABLE
	);
	
	/**
	 * @access public
	 * @staticvar array $fontIdList - list of all font id's
	 */
	public static $fontIdList = array(
		self::FONT_FAMILY,
		self::FONT_SIZE
	); 
	
	/**
	 * @access public
	 * @staticvar array $colourChoiceList - list of all colours of the colour choice list
	 */
	public static $colourChoiceList = array(
		'#fff', 
		'#000', 
		'#a9a9a9', 
		'#808080', 
		'#d3d3d3', 
		'#00008b', 
		'#0000ff',
		'#add8e6',
		'#40e0d0', 
		'#ffa500', 
		'#ffff00', 
		'#ffffa3', 
		'#8b0000', 
		'#ff0000',
		'#ffb6c1',
		'#ee82ee',
		'#006400',
		'#008000',
		'#90ee90',
		'#a52a2a'
	);
	
	/**
	 * @access public
	 * @staticvar array $fontFamilyChoiceList - list of all allowed font families
	 */
	public static $fontFamilyChoiceList = array(
		'Arial',
		'Courier New',
		'Helvetica',
		'monospace',
		'Times New Roman'
	);
	
	/**
	 * @access public
	 * @staticvar array $fontSizeChoiceList - list of all allowed font sizes
	 */
	public static $fontSizeChoiceList = array('10px', '11px', '12px', '13px', '14px');
	
	/**
	 * Creates colour column for the given id.
	 * 
	 * @access public
	 * @static
	 * @param string $id - colour id
	 * @param array $colours
	 * @param array $colourTypes
	 */
	public static function createColourColumnById($id, $colours, $colourTypes)
	{
		$colour = $colours[$id];
		$colourType = $colourTypes[$id];
		?>
		<td>
			<select id="<?php echo $id; ?>Select" name="<?php echo $id; ?>Select"<?php echo (int)$colourType === self::COLOUR_TYPE_LIST ? ' style="background:'.$colour.'"' : '' ?>>
				<?php self::checkColourSelectStatus($colour, $colourType); ?>
			</select>
		</td>
		<td>
			<input id="<?php echo $id; ?>Code" type="text" name="<?php echo $id; ?>Code" value="<?php echo (int)$colourType === self::COLOUR_TYPE_CODE ? $colour : ''; ?>" /><img id="<?php echo $id; ?>Img" src="../image-files/accept.png" width="16" height="16" alt="OK" title="OK" />
		</td>
		<td class="curColour" style="background:<?php echo $colour; ?>;">&#160;</td>
		<?php 	
	}
	
	/**
	 * Checks colour column select status.
	 * 
	 * @access private
	 * @static 
	 * @param array $colour
	 * @param array $colourType
	 */
	private static function checkColourSelectStatus($colour, $colourType)
	{
		echo '<option value="colourCodeUsed">Farbcode</option>';
		foreach(self::$colourChoiceList as $choiceColour)
		{
			$selected = '';
			if((int)$colourType === self::COLOUR_TYPE_LIST && $choiceColour === $colour)
				{
					$selected = ' selected="selected"';
				}
				echo '<option'.$selected.' value="'.$choiceColour.'" style="background:'.$choiceColour.';">&#160;</option>';
			}
	}
	
	/**
	 * Creates font column for the given id.
	 * 
	 * @access public
	 * @static
	 * @param $id - font id
	 * @param $fontSetting - font setting for the given id
	 */
	public static function createFontColumnById($id, $fontSetting)
	{
		$fontChoiceList = $id === self::FONT_FAMILY ? self::$fontFamilyChoiceList : self::$fontSizeChoiceList;
		foreach($fontChoiceList as $choiceFont)
		{
			$selected = '';
			if($choiceFont === $fontSetting)
			{
				$selected = ' selected="selected"';
			}
			echo '<option'.$selected.' value="'.$choiceFont.'">'.$choiceFont.'</option>';
		}
	}
	
	/**
	 * Handles form submit, collects all design settings, saves them, call css and image creator
	 * and forwards back to the design view.
	 * 
	 * @access public
	 * @static
	 */
	public static function handleFormSubmit()
	{
		$colours = array();
		$colourTypes = array();
		foreach(self::$colourIdList as $id)
		{
			if(!empty($_POST[$id.'Select']))
			{
				if($_POST[$id.'Select'] === 'colourCodeUsed' && !empty($_POST[$id.'Code']))
				{
					$colours[$id] = $_POST[$id.'Code'];
					$colourTypes[$id] = self::COLOUR_TYPE_CODE;
				}
				else 
				{
					$colours[$id] = $_POST[$id.'Select'];
					$colourTypes[$id] = self::COLOUR_TYPE_LIST; 	
				}
			}
		}
		$fontFamily = '';
		$fontSize = '';
		foreach(self::$fontIdList as $id)
		{
			if(!empty($_POST[$id]))
			{
				if($id === self::FONT_FAMILY)
				{
					$fontFamily = $_POST[$id];
				}
				else
				{
					$fontSize = $_POST[$id];
				}
			}
		}
		$configuration = Configuration::getInstance();
		$configuration->setColours($colours);
		$configuration->setColourTypes($colourTypes);
		$configuration->setFontFamily($fontFamily);
		$configuration->setFontSize($fontSize);
		$configuration->saveSettings();
		CSSCreator::createCssFiles($configuration->getShowCopyright(), $configuration->getShowLastUpdate(), $configuration->getColours(), $configuration->getFontFamily(), $configuration->getFontSize());
		ImageCreator::createOccuPlanImages($configuration->getFontSize(), $configuration->getColours());
		header("location: ../view-admin-files/design.php");
		exit();
	}
}
?>