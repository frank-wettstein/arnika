<?php
/**
 * Class CSSCreator
 * 
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class that creates the needed css files for the occupancy plan application.
 */
class CSSCreator
{
	/**
	 * @access const
	 * @var FILE_PATH - file path for the css files
	 */
	const FILE_PATH = '../css-files/';
	
	/**
	 * @access const
	 * @var STYLES_FILE_NAME - file name for the css file for the frontend
	 */
	const STYLES_FILE_NAME = 'styles.css';
	
	/**
	 * @access const
	 * @var STYLES_ADMIN_FILE_NAME - file name for the css file for the backend
	 */
	const STYLES_ADMIN_FILE_NAME = 'styles-admin-plan.css';
	
	/**
	 * Creates the css files for the frontend and backend.
	 * 
	 * @access public
	 * @static
	 * @param bool $showCopyright - show copyright indicator
	 * @param bool $showLastUpdate - show last update indicator
	 * @param bool $colours - colours of the occupancy plan
	 * @param string $fontFamily - font family of the occupancy plan
	 * @param string $fontSize - font size of the occupancy plan
	 */
	public static function createCssFiles($showCopyright, $showLastUpdate, $colours, $fontFamily, $fontSize)
	{
		if(file_exists(self::FILE_PATH.self::STYLES_FILE_NAME))
		{
			unlink(self::FILE_PATH.self::STYLES_FILE_NAME);
		}
		if(file_exists(self::FILE_PATH.self::STYLES_ADMIN_FILE_NAME))
		{
			unlink(self::FILE_PATH.self::STYLES_ADMIN_FILE_NAME);
		}

		$showCopyrightCss = '';
		$showLastUpdateCss = '';
		
		$apartmentNameColour = $colours[DesignHelper::COLOUR_ID_APARTMENT_NAME];
		$apartmentNameFontColour = $colours[DesignHelper::COLOUR_FONT_ID_APARTMENT_NAME];
		$borderOccuPlanTableColour = $colours[DesignHelper::COLOUR_BORDER_ID_OCCU_PLAN_TABLE];
		$dayColour = $colours[DesignHelper::COLOUR_ID_DAY];
		$dayFontColour = $colours[DesignHelper::COLOUR_FONT_ID_DAY];
		$dayTypeFree = $colours[DesignHelper::COLOUR_DAY_TYPE_ID_FREE];
		$dayTypeNotToOccupy = $colours[DesignHelper::COLOUR_DAY_TYPE_ID_NOT_TO_OCCUPY];
		$dayTypeOccupied = $colours[DesignHelper::COLOUR_DAY_TYPE_ID_ARRIVAL_DEPARTURE_OCCUPIED];
		$footerInformationsColour = $colours[DesignHelper::COLOUR_ID_FOOTER_INFORMATIONS];
		$footerInformationsFontColour = $colours[DesignHelper::COLOUR_FONT_ID_FOOTER_INFORMATIONS];
		$monthColour = $colours[DesignHelper::COLOUR_ID_MONTH];
		$monthFontColour = $colours[DesignHelper::COLOUR_FONT_ID_MONTH];
		$occuPlanTableColour = $colours[DesignHelper::COLOUR_ID_OCCU_PLAN_TABLE];
		$weekdayFontColour = $colours[DesignHelper::COLOUR_FONT_ID_WEEKDAY];
		$weekendColour = $colours[DesignHelper::COLOUR_ID_WEEKEND];
		$yearColour = $colours[DesignHelper::COLOUR_ID_YEAR];
		$yearFontColour = $colours[DesignHelper::COLOUR_FONT_ID_YEAR];
		
		if($showCopyright || $showLastUpdate)
		{
			$footerInformations = '#occuPlanFooter{background:'.$footerInformationsColour.';border:1px_'.$borderOccuPlanTableColour.'_solid;}';
		}
		if($showCopyright)
		{
			if($showLastUpdate)
			{
				$showCopyrightCss .= '#showCopyrightFooter{float:left;}';
			}
			$showCopyrightCss .= '
				#showCopyrightFooter_a{margin:0_0_0_3px;color:'.$footerInformationsFontColour.';text-decoration:none;}
				#showCopyrightFooter_a:hover{color:'.$footerInformationsFontColour.';text-decoration:underline;}
			';
		}
		if($showLastUpdate)
		{
			$showLastUpdateCss = '#showLastUpdateFooter{margin:0_3px_0_0;color:'.$footerInformationsFontColour.';text-align:right;}';
		}
		
		$inputDataString = '
			#occuPlanLegend_div{float:left;margin:0_4px_2px_0;}
			#occuPlanLegend_img{float:left;margin:0_4px_0_0;border:1px_#000_solid;background:no-repeat_center;}
			#legendOccupied,#legendNotToOccupy{height:12px;width:12px;border:1px_'.$borderOccuPlanTableColour.'_solid;}
			#occuPlanTable{clear:both;background:'.$occuPlanTableColour.';border-collapse:collapse;border:1px_'.$borderOccuPlanTableColour.'_solid;text-align:center;}
			.year{background:'.$yearColour.';color:'.$yearFontColour.';border:1px_'.$borderOccuPlanTableColour.'_solid;}
			.monthName{background:'.$monthColour.';color:'.$monthFontColour.';border:1px _'.$borderOccuPlanTableColour.'_solid;}
			.day{background:'.$dayColour.';color:'.$dayFontColour.';}
			.day_td{border:1px_'.$borderOccuPlanTableColour.'_solid;}
			.free{background:'.$dayTypeFree.';}
			.free_td{border:1px_'.$borderOccuPlanTableColour.'_solid;}
			.occupied,#legendOccupied{background:'.$dayTypeOccupied.';}
			.notToOccupy,#legendNotToOccupy{background:'.$dayTypeNotToOccupy.';}
			.week{color:'.$weekdayFontColour.';background:center;}
			.week_td{border:1px_'.$borderOccuPlanTableColour.'_solid;}
			.noweek{border:0 !important;}
			.weekend{background:'.$weekendColour.';color:'.$weekdayFontColour.';border:1px_'.$borderOccuPlanTableColour.'_solid;}			
			.apartmentName{background:'.$apartmentNameColour.';color:'.$apartmentNameFontColour.';border:1px_'.$borderOccuPlanTableColour.'_solid;}
			'.$footerInformations.'
			'.$showCopyrightCss.'
			'.$showLastUpdateCss.'
		';
		
		file_put_contents(self::FILE_PATH.self::STYLES_ADMIN_FILE_NAME, self::removeWhitespaces($inputDataString));

		$width = '19px';
		$lineHeight = '19px';
		if($fontSize === '13px')
		{
			$width = '20px';
			$lineHeight = '20px';
		}
		elseif($fontSize === '14px')
		{
			$width = '21px';
			$lineHeight = '21px';
		}
		$fontFamily = preg_replace('/ /', '_', $fontFamily);
		$inputDataString .= '
			#occuPlanWrapper{font-size:'.$fontSize.';font-weight:bold;font-family:'.$fontFamily.';}
			#occuPlanLegend_a{color:#162b6c;text-decoration:none;}
			#occuPlanLegend_a:hover{text-decoration:underline;}
			#monthSelection_span{cursor:pointer;}#monthSelection_img{margin:0_0_0_5px;padding:1px;border:0;}
			#occuPlanTable_td{padding:0;width:'.$width.';line-height:'.$lineHeight.';}
			.arrival{background:url("../image-files/arrival.png?update='.filemtime("../image-files/arrival.png").'")_no-repeat_0_0;}
			.arrivalDeparture{background:url("../image-files/arrivalDeparture.png?update='.filemtime("../image-files/arrivalDeparture.png").'")_no-repeat_0_0;}
			.departure{background:url("../image-files/departure.png?update='.filemtime("../image-files/departure.png").'")_no-repeat_0_0;}
			#b3Months,#b1Months,#f3Months,#f1Months{float:left;width:12px;height:12px;margin:1px_0_0_5px;background:url("../image-files/arrows.png");}#b3Months{background-position:0_-39px;}#b1Months{background-position:0_-26px;}#f3Months{background-position:0_-91px;}#f1Months{background-position:0_-78px;}
		';

		file_put_contents(self::FILE_PATH.self::STYLES_FILE_NAME, self::removeWhitespaces($inputDataString));
	}
	
	/**
	 * Returns a minified css data string.
	 * 
	 * @access private
	 * @static
	 * @param string $inputDataString - string that includes the content for the css files
	 * @return string $inputDataString - whitespaces cleaned string
	 */
	private static function removeWhitespaces($inputDataString)
	{
		$inputDataString = preg_replace('/\s/', '', $inputDataString);
		$inputDataString = preg_replace('/_/', ' ', $inputDataString);
		return $inputDataString;
	}
}
?>