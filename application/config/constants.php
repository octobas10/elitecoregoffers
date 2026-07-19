<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/* ************/
define('SITE_TITLE',"Elite Coreg Offers");

/* *****************
 * DEFINE TABLES
 ******************/
define('SITE_OFFERS_TRANS_TABLE','site_offers_trans');
define('OFFER_TRANS_TABLE','offer_trans');
define('OFFER_DATA_TABLE','offer_data');
define('FTP_DATA_TABLE','ftp_data');
/*****************/
$DISPLAY_OFFER_TYPE = array("fullpage_display"=>"Full Page Offer",
							"vertical_display"=>"Elite - Vertical Offer",
							"horizontal_display"=>"Coreg - Horizontal Offer",
							"pop_display"=>"Pop Offer");

$AFFILIATE_NAMES = array("1"=>"Elitemate.com");
$SO_STATE_EXIT = array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10");	
//our fields
$SYSTEM_FIELDS = array("other"=>"Other",
					"so_first_name"=>"First Name",
					"so_last_name"=>"Last Name",
					"so_email"=>"Email",
					"so_dob"=>"Date Of Birth",
					"so_gender"=>"Gender",
					"so_homephone"=>"Home Phone",
					"so_workphone"=>"Work Phone",
					"so_mobilephone"=>"Mobile Phone",
					"so_address"=>"Address",
					"so_city"=>"City",
					"so_state"=>"State",
					"so_country"=>"Country",
					"so_zipcode"=>"Zipcode",
					"so_ip"=>"IP Address",
					"so_date"=>"DATE ENTERED",
					"fixed"=>"Fixed",
);

$CLIENT_RESPONSE_TYPE = array("xml"=>"XML",
							  "json"=>"JSON",
							  "simple_text"=>"SIMPLE TEXT");

/*
 * Define ADMINISTRATOR Details
 */
define('ADMIN_NAME',"");
define('ADMIN_EMAIL',"");
define('SMTP_HOST','ssl://smtp.gmail.com');
define('SMTP_PORT','465');
define('SMTP_USERNAME','');
define('SMTP_PASSWORD','');
/**
18 November 2016 18:01 PM
*/
define('CUR_DATETIME',date('Y-m-d H:i:s'));
define('REMOTE_IPADDR',$_SERVER['REMOTE_ADDR']);
