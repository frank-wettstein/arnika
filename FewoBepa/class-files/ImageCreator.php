<?php
/**
 * Class Imagereator
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class that creates occupancy plan images.
 */ 
class ImageCreator
{
	/**
	 * @access const
	 * @staticvar FILE_PATH - file path for the image files
	 */
	const FILE_PATH = '../image-files/';
	
	/**
	 * @access private
	 * @staticvar string $imageWidth - defined image width
	 */
	private static $imageWidth = 19;
	
	/**
	 * @access private
	 * @staticvar string $imageHeight - defined image height
	 */
	private static $imageHeight = 19;
	
	/**
	 * @access private
	 * @staticvar string $colourOccupied - colour code for the occupied images
	 */
	private static $colourOccupied = '';
	
	/**
	 * @access private
	 * @staticvar bool $isAdminImage - indicator if it's an admin image or not
	 */
	private static $isAdminImage = true;
	
	/**
	 * Constructor that is private so that it is not possible to get an instance of this class.
	 * 
	 * @access private
	 */
	private function __construct() { }
	
	/**
	 * Creates the occupancy plan images.
	 * 
	 * @access public
	 * @static
	 * @param string $fontSize
	 * @param array $colours
	 */
	public static function createOccuPlanImages($fontSize, $colours)
	{
		self::$colourOccupied = $colours[DesignHelper::COLOUR_DAY_TYPE_ID_ARRIVAL_DEPARTURE_OCCUPIED];

		self::createArrivalImage();
		self::createArrivalDepartureImage();
		self::createDepartureImage();
		
		self::$isAdminImage = false;
		
		if($fontSize === '13px')
		{
			self::$imageWidth = 20;
			self::$imageHeight = 20;
		}
		elseif($fontSize === '14px')
		{
			self::$imageWidth = 22;
			self::$imageHeight = 22;
		}

		self::createArrivalImage();
		self::createArrivalDepartureImage();
		self::createDepartureImage();
	}
	
	/**
	 * Creates arrival image.
	 * 
	 * @access private
	 * @static
	 */
	private static function createArrivalImage()
	{
		$dayTypeImage = self::getTransparentImageWithGivenSize();
		$decColourArray = self::hexToDec(self::$colourOccupied);
		$colourOccupied = imagecolorallocate($dayTypeImage, $decColourArray[0], $decColourArray[1], $decColourArray[2]);
		if(self::$isAdminImage)
		{
			$pointsArrival = array(19, 0, 0, 19, 19, 19);
			$imageFileName = 'arrival-acp.png';
		}
		else
		{
			$coW = self::$imageWidth;
			$coH = self::$imageHeight;
			$pointsArrival = array($coW, 0, 0, $coH, $coW, $coH);
			$imageFileName = 'arrival.png';
		}
		imagefilledpolygon($dayTypeImage, $pointsArrival, 3, $colourOccupied);
		self::saveImageByName($dayTypeImage, $imageFileName);
	}
	
	/**
	 * Creates arrival departure image.
	 * 
	 * @access private
	 * @static
	 */
	private static function createArrivalDepartureImage()
	{
		$dayTypeImage = self::getTransparentImageWithGivenSize();
		$decColourArray = self::hexToDec(self::$colourOccupied);
		$colourOccupied = imagecolorallocate($dayTypeImage, $decColourArray[0], $decColourArray[1], $decColourArray[2]);
		if(self::$isAdminImage)
		{
			$pointsArrival = array(19, 4, 4, 19, 19, 19);
			$pointsDeparture = array(0, 0, 0, 12, 12, 0);
			$imageFileName = 'arrivalDeparture-acp.png';
		}
		else
		{
			$coW = self::$imageWidth;
			$coH = self::$imageHeight;
			$pointsArrival = array($coW, 4, 4, $coH, $coW, $coH);
			$pointsDeparture = array(0, 0, 0, 12, 12, 0);
			$imageFileName = 'arrivalDeparture.png';
		}
		imagefilledpolygon($dayTypeImage, $pointsArrival, 3, $colourOccupied);
		imagefilledpolygon($dayTypeImage, $pointsDeparture, 3, $colourOccupied);
		self::saveImageByName($dayTypeImage, $imageFileName);
	}
	
	/**
	 * Creates departure image.
	 * 
	 * @access private
	 * @static
	 */
	private static function createDepartureImage()
	{
		$dayTypeImage = self::getTransparentImageWithGivenSize();
		$decColourArray = self::hexToDec(self::$colourOccupied);
		$colourOccupied = imagecolorallocate($dayTypeImage, $decColourArray[0], $decColourArray[1], $decColourArray[2]);
		if(self::$isAdminImage)
		{
			$pointsDeparture = array(0, 0, 0, 19, 19, 0);
			$imageFileName = 'departure-acp.png';
		}
		else
		{
			$coW = self::$imageWidth;
			$coH = self::$imageHeight;
			$pointsDeparture = array(0, 0, 0, 19, 19, 0);
			$imageFileName = 'departure.png';
		}
		imagefilledpolygon($dayTypeImage, $pointsDeparture, 3, $colourOccupied);
		self::saveImageByName($dayTypeImage, $imageFileName);
	}
	
	/**
	 * Returns pointer that points on allocated memory for an image with the given width and height.
	 * 
	 * @access private
	 * @static
	 * @return pointer $image - pointer on allocated memory for image
	 */
	private static function getTransparentImageWithGivenSize()
	{
		$image = imagecreate(self::$imageWidth, self::$imageHeight);
		$colourBlack = imagecolorallocate($image, 0, 0, 0);
		imagecolortransparent($image, $colourBlack);
		return $image;
	}
	
	/**
	 * Saves the image as png-image.
	 * 
	 * @access private
	 * @static
	 * @param pointer $dayTypeImage - pointer on allocated memory for image
	 * @param string $fileName- file name for the image file
	 */
	private static function saveImageByName($image, $fileName)
	{
		if(file_exists(self::FILE_PATH.$fileName))
		{
			unlink(self::FILE_PATH.$fileName);
		}
		header('Content-Type: image/png');
		imagepng($image, self::FILE_PATH.$fileName);
		imagedestroy($image);
	}
	
	/**
	 * Returns the decimal RGB-parts of the given hex colour string.
	 * 
	 * @access private
	 * @static
	 * @param string $hexColour - given hex colour with format: #123456
	 * @return array $decColours - array($decColourR, $decColourG, $decColourB)
	 */
	private static function hexToDec($hexColour)
	{
		$hexColour = substr($hexColour, 1);
		$hexColourR = substr($hexColour, 0, 2);
		$hexColourG = substr($hexColour, 2, 2);
		$hexColourB = substr($hexColour, 4, 2);
		$decColourR = hexdec($hexColourR);
		$decColourG = hexdec($hexColourG);
		$decColourB = hexdec($hexColourB);
		return array($decColourR, $decColourG, $decColourB);
	}
}
?>