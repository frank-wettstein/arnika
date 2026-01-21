<?php
/**
 * Class Authentication
 *
 * PHP version 5.3
 *
 * @author     Stephan L.
 * @copyright  Copyright (c) 2013 - Stephan L.
 * @license    http://www.belegungsplan-fewo.de/lizenz.php
 * @link       http://www.belegungsplan-fewo.de/
 */

/**
 * Class for creating login data file and provides login and logout functionality.
 */
final class Authentication
{
	/**
	 * @access const
	 * @var FILE_PATH - file path for the password file
	 */
	const FILE_PATH = '../save-files/';
	
	/**
	 * @access const
	 * @var HTPASSWD_FILE_NAME - file name for the password file
	 */
	const HTPASSWD_FILE_NAME = '.htpasswd';
	
	/**
	 * Constants for the views.
	 * 
	 * @access const
	 */
	const VIEW_CREATE_LOGIN = 1;
	const VIEW_LOGIN = 2;
	const VIEW_NO_LOGIN = 3;
	
	/**
	 * @access private
	 * @staticvar bool $hasErrors - indicator for errors
	 */
	private static $hasErrors = false;
	
	/**
	 * @access private
	 * @staticvar array $errors - keeps all error messages
	 */
	private static $errors = array();
	
	/**
	 * Constructor that is private so that it is not possible to get an instance of this class.
	 * 
	 * @access private
	 */
	private function __construct() { }
	
	/**
	 * Creates login data file when validation does not fail and then forwards to the login page.
	 * 
	 * @access public
	 * @static
	 * @param string $username
	 * @param string $password
	 * @param string $repeatPassword
	 */
	public static function createLogin($username, $password, $repeatPassword)
	{
		self::validateUsername($username);
		self::validatePassword($password, $repeatPassword);
		if(self::$hasErrors) return false;
		$encryptedPassword = self::createEncryptedPassword($password);
		self::createLoginDataFile($username, $encryptedPassword);
		header("location: ../view-admin-files/login.php");
		exit();
	}
	
	/**
	 * Updates the login data (username can not be updated - just password) when validation does not fail.
	 * 
	 * @access public
	 * @static
	 * @param string $oldPassword
	 * @param string $newPassword
	 * @param string $newRepeatPassword
	 */
	public static function updateLogin($oldPassword, $newPassword, $newRepeatPassword)
	{
	}
	
	/**
	 * Checks if user already logged in and if not forwards to the login page. 
	 * 
	 * @access public
	 * @static
	 * @param $view - id of the view
	 */
	public static function ensureLogin($view)
	{
		if(!file_exists(self::FILE_PATH.self::HTPASSWD_FILE_NAME))
		{
			if($view !== self::VIEW_CREATE_LOGIN)
			{
				header("location: ../view-admin-files/createLogin.php");
				exit();
			}
		}
		elseif(!Session::check('username') || !Session::check('password'))
		{
			if($view !== self::VIEW_LOGIN)
			{
				header("location: ../view-admin-files/login.php");
				exit();
			}
		}
		elseif($view === self::VIEW_CREATE_LOGIN || $view === self::VIEW_LOGIN) 
		{
			header("location: ../view-admin-files/admin.php");
			exit();
		}
	}
	
	/**
	 * Login for an user if username and password are correct.
	 * 
	 * @access public
	 * @static
	 * @param string $username
	 * @param string $password
	 */
	public static function login($username, $password)
	{
		if(file_exists(self::FILE_PATH.self::HTPASSWD_FILE_NAME))
		{
			$fileContent = file(self::FILE_PATH.self::HTPASSWD_FILE_NAME);
			foreach($fileContent as $data)
			{
				$loginData = explode(':', $data);
				if(count($loginData) === 2)
				{
					$encryptedPassword = self::createEncryptedPassword($password, $loginData[1]);
					if($loginData[0] === $username && $loginData[1] === $encryptedPassword)
					{
						Session::write('username', $username);
						Session::write('password', $encryptedPassword);
						header("location: ../view-admin-files/admin.php");
						exit();
					}
					else
					{
						self::addError('Benutzername oder Passwort ist falsch.');
					}
				}
			}
		}
	}
	
	/**
	 * Logouts the current user by destroying the session and then forwards back to the login page.
	 * 
	 * @access public
	 * @static
	 */
	public static function logout()
	{
		Session::destroy();
		header("location: ../view-admin-files/login.php");
		exit();
	}
	
	/**
	 * Returns true if there are errors and false if not.
	 * 
	 * @access public
	 * @static
	 * @return bool $hasErrors
	 */
	public static function hasErrors()
	{
		return self::$hasErrors;
	}
	
	/**
	 * Returns the error messages as an array.
	 * 
	 * @access public
	 * @static
	 * @return array $errors
	 */
	public static function getErrors()
	{
		return self::$errors;
	}
	
	/**
	 * Returns the given password encrypted.
	 * 
	 * @access public
	 * @static
	 * @param string $password
	 * @param string $salt
	 * @return string $encryptedPassword
	 */
	private static function createEncryptedPassword($password, $salt = null)
	{
		if(isset($salt))
		{
			return crypt($password, $salt); 
		}
		else 
		{
			return crypt($password);
		}
	}
	
	/**
	 * Creates login data file.
	 * 
	 * @access private
	 * @static
	 * @param string $username
	 * @param string $encryptedPassword
	 */
	private static function createLoginDataFile($username, $encryptedPassword)
	{
		file_put_contents(self::FILE_PATH.self::HTPASSWD_FILE_NAME, $username.':'.$encryptedPassword);
	}
	
	/**
	 * Valdiates the given username.
	 * 
	 * @access private
	 * @param string $username
	 */
	private static function validateUsername($username)
	{
		if(empty($username) || mb_strlen($username) <= 2)
		{
			self::addError('Der Benutzername darf nicht leer sein und muss aus min. 3 Zeichen bestehen.');
		}
	}
	
	/**
	 * Valitates the given password.
	 * 
	 * @access private
	 * @static
	 * @param $password
	 * @param $repeatPassword
	 */
	private static function validatePassword($password, $repeatPassword)
	{
		if(empty($password) || mb_strlen($password) <= 2)
		{
			self::addError('Das Passwort darf nicht leer sein und muss aus min. 8 Zeichen bestehen.');
		}
		if(empty($repeatPassword) || $password !== $repeatPassword)
		{
			self::addError('Die eingegebenen PasswÃƒÆ’Ã‚Â¶rter mÃƒÆ’Ã‚Â¼ssen ÃƒÆ’Ã‚Â¼bereinstimmen.');
		}
	}
	
	/**
	 * Adds error messages to the error array.
	 * 
	 * @param string $message
	 */
	private static function addError($message)
	{
		self::$errors[] = $message;
		self::$hasErrors = true;
	}
}
?>