<?php
namespace ThousandMonkeys\PHPBBAuthBundle\Security\User;

/**
 * Integration with phpBB v3 forums
 * (c) Amir Wald 2008 - http://colnect.com
 * (c) modified by Robert Heim 2010 - http://blog.robert-heim.de
 * (c) Updated by Rob Lang 2012 for Symfony 2 - http://www.1km1kt.net
 */
class PHPBBIntegration
{
	private static $forumUrl;
	private static $forumPath;
	private static $dbServer;
	private static $dbCatalog;
	private static $dbUser;
	private static $dbPassword;
	private static $dbPrefix;
	private static $dbAnonymous = 1;
 
	private static $link = null;
	private static $cookies = null;
 	private static $user_information = null;
 	private static $user_roles = null;
	
 	public static function Setup($fUrl, $fPath, $dServer, $dCatalog, $dUser, $dPassword, $dPrefix)
 	{
 		self::$forumUrl = $fUrl;
 		self::$forumPath = $fPath;
 		self::$dbServer = $dServer;
 		self::$dbCatalog = $dCatalog;
 		self::$dbUser = $dUser;
 		self::$dbPassword = $dPassword;
 		self::$dbPrefix = $dPrefix;
 	}

	/**
	 * Checks if the user is logged in to the Phpbb
	 *
	 * @return boolean - true if the user is logged in to Phpbb, false otherwise
	 * @author (c) Robert Heim 2010 - http://blog.robert-heim.de
	 */
	public static function isUserLoggedIn()
	{
		return (self::checkSession() > 0);
	}

	/**
	 * If the user is logged into PHPBB, returns the user id - 0 otherwise!
	 *
	 * @return the user's Id, 0 if one is not logged in
	 * @author (c) Rob Lang 2012 - http://www.1km1kt.net
	 */
	public static function getLoggedInUserId()
	{
		return self::checkSession();
	}

	/**
	 * Returns the simple user information from PHPBB
	 *
	 * @return an associative array of user's basic information
	 * @author (c) Rob Lang 2012 - http://www.1km1kt.net
	 */
	public static function getUserInformation($user_id)
	{
		if ($user_id == 0)
		{
			return;
		}

		if (!is_null(self::$user_information))
		{
			return self::$user_information;
		}

		$sql = "SELECT username, user_email, user_avatar FROM " . self::$dbPrefix . "_users WHERE user_id=$user_id";
		$result = self::sqlExecuteQuery($sql);
		if (mysql_num_rows($result) <= 0) 
		{
			return;
		}
		else
		{
			$user_data = mysql_fetch_array($result);
			self::$user_information = array('id' => $user_id,
											'username' => $user_data['username'],
											'email' => $user_data['user_email'],
											'avatar' => $user_data['user_avatar']);
		}
		mysql_free_result($result);
		return self::$user_information;
	}

	/**
	 * Returns the user's GROUPS from PHPBB. In this case, PHPBB really uses groups to manages roles
	 *
	 * @return an associative array of user's roles
	 * @author (c) Rob Lang 2012 - http://www.1km1kt.net
	 */
	public static function getUserRoles($user_id)
	{
		if ($user_id == 0)
		{
			return;
		}

		if (!is_null(self::$user_roles))
		{
			return self::$user_roles;
		}

		$sql = "SELECT group_name FROM " . self::$dbPrefix ."_groups g INNER JOIN " . self::$dbPrefix . "_user_group ug GROUP BY g.group_name, ug.user_id HAVING ug.user_id=$user_id";
		$result = self::sqlExecuteQuery($sql);

		if (mysql_num_rows($result) <= 0) 
		{
			return;
		}
		else
		{
			self::$user_roles = array();
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    			self::$user_roles[] = $row['group_name'];
			}
		}
		mysql_free_result($result);
		return self::$user_roles;
	}

	/**
	 * Gets the link to phpBB database
	 *
	 * @return resource - a MySQL link identifier on success, throws Exception on error
	 * @author (c) Robert Heim 2010 - http://blog.robert-heim.de
	 */
	private static function getDbConnection()
	{
		if (!is_null(self::$link))
		{
			return self::$link;
		}
 
		self::$link = @mysql_connect(self::$dbServer, self::$dbUser, self::$dbPassword);
		if (self::$link && @mysql_select_db(self::$dbCatalog, self::$link))
		{
			return self::$link;
		}
 
		throw new Exception("getDbConnection failed. MESSAGE [[file:".__FILE__.' line:'.__LINE__.": ".mysql_error()."]]");
		return self::$link;
	}
 
	/**
	 * Execute SQL query on phpBB database
	 *
	 * @param string $sql
	 * @return resource
	 */
	private static function sqlExecuteQuery($sql)
	{
		if (!($result = @mysql_query($sql, self::getDbConnection()))) {
			throw new Exception("sqlExecuteQuery failed. QUERY [[$sql]] MESSAGE [[".mysql_error()."]]");
		}
		return $result;
	}
 
	/**
	 * Validates a users session from phpBB cookies against the db.
	 *
	 * @return integer - user_id if the user is logged in to Phpbb, 0 otherwise
	 * @author (c) Robert Heim 2010 - http://blog.robert-heim.de
	 */
	private static function checkSession()
	{
		$cookies = self::readCookies(self::getConfigVal('cookie_name'));
 
		if ($cookies['user_id'] != null && $cookies['sessionId'] != null )
		{
			// check session
			$user_id = self::checkDbSession((int)$cookies['user_id'], $cookies['sessionId']);
			if ($user_id > 0)
			{
				// user is logged in and has a valid session
				return $user_id;
			}
		}
 
		// no valid session yet.
 
		// check session-key ("remember me"-feature)
		if ($cookies['sessionKey'] == null)
		{
			// key is missing
			return 0;
		}
 
		// get checkDbSessionKey
		$user_id = self::checkDbSessionKey($cookies['sessionKey']);
		if ($user_id <= 0)
		{
			// the session key was not found in the db
			return 0;
		}
 
		$sessionId = self::getSessionId($cookies['user_id']);
		if ($sessionId == '')
		{
			// there was no valid session and a new one was not created during the getSessionId(...)
			// so we don't have a session and the user is not logged in.
			return 0;
		}
 
		return $user_id;
	}
 
 
	/**
	 * Get a configuration value from phpBB's database
	 *
	 * @param string $name - value name
	 * @return string - the value
	 */
	private static function getConfigVal($name)
	{
		$sql = "SELECT config_value FROM " . self::$dbPrefix . "_config WHERE config_name LIKE '$name'";
		$result = self::sqlExecuteQuery($sql);
		$ar = mysql_fetch_array($result);
		return $ar['config_value'];
	}
 
	/**
	 * Gets the session_id for a user_id from the sessions-table of phpbb3.
	 *
	 * @param integer $user_id
	 * @return string - session_id if the user is logged in to Phpbb, '' otherwise
	 * @author (c) Robert Heim 2010 - http://blog.robert-heim.de
	 */
	private static function getSessionId($user_id)
	{
		if (!is_int($user_id) || $user_id < 1 || $user_id === self::$dbAnonymous) {
			return '';
		}
		$user_id = mysql_real_escape_string($user_id, self::getDbConnection());
 
		$sql = "SELECT session_id FROM " . self::$dbPrefix ."_sessions WHERE session_user_id=$user_id";
		$result = self::sqlExecuteQuery($sql);
 
		if (mysql_num_rows($result) <= 0) 
		{
			return '';
		}
		else
		{
			$session_ar = mysql_fetch_array($result);
		
			$time_now = time();
			$sql = "UPDATE " . self::$dbPrefix . "_sessions SET session_time='$time_now' WHERE session_user_id=$user_id";
			$result = self::sqlExecuteQuery($sql);

			return $session_ar['session_id'];
		}
		return '';
	}
 
	/**
	 * Check user's session(s) from phpBB's database
	 *
	 * @param integer $user_id
	 * @param integer $sid session_id
	 * @return integer - user_id if the user is logged in to Phpbb, 0 otherwise
	 * @author (c) Robert Heim 2010 - http://blog.robert-heim.de
	 */
	private static function checkDbSession($user_id, $sid)
	{
		if (!is_int($user_id) || $user_id < 1 || $user_id === self::$dbAnonymous) {
			return 0;
		}

		$user_id = mysql_real_escape_string($user_id, self::getDbConnection());
		$sid = mysql_real_escape_string($sid, self::getDbConnection());
 
		$sql = "SELECT session_id FROM " . self::$dbPrefix . "_sessions WHERE session_user_id=$user_id AND session_id='$sid'";
		$result = self::sqlExecuteQuery($sql);

		if (mysql_num_rows($result) <= 0) 
		{
			return 0;
		}
		return $user_id;
	}
 
	/**
	 * Validates a users session_key with the phpBB's database
	 *
	 * @param string $sessoin_key
	 * @return integer - user_id if the key is in the db, 0 otherwise
	 * @author (c) Robert Heim 2010 - http://blog.robert-heim.de
	 */
	private static function checkDbSessionKey($session_key)
	{
		$session_key = mysql_real_escape_string($session_key, self::getDbConnection());
 
		$sql = "SELECT user_id FROM ".self::$dbPrefix . "_sessions_keys WHERE key_id='$session_key'";
		$result = self::sqlExecuteQuery($sql);

		if (mysql_num_rows($result) <= 0) 
		{
			return 0;
		}

		$session_key_ar = mysql_fetch_array($result);
 
		return (int)$session_ar['user_id'];
	}
 
	/**
	 * reads client cookies of the phpBB3
	 *
	 * @param string $phpbbCookieName
	 * @return array - $phpbbCookieName
	 * @author (c) Robert Heim 2010 - http://blog.robert-heim.de and Rob Lang
	 */
	private static function readCookies($phpbbCookieName)
	{
		if(is_null(self::$cookies))
		{
			$sessionKey =  $_COOKIE[$phpbbCookieName.'_k'];
			$user_id = $_COOKIE[$phpbbCookieName.'_u'];
			$sessionId = $_COOKIE[$phpbbCookieName.'_sid'];
			$cookies = array('sessionKey' => $sessionKey,
							'user_id' => $user_id,
							'sessionId' => $sessionId,
			);
			self::$cookies = $cookies;
		}
		return self::$cookies;
	}
 
}