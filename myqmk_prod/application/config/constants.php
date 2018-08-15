<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('LOGIN_TYPE_LOCAL')		OR define('LOGIN_TYPE_LOCAL', '1');
defined('LOGIN_TYPE_FB')		OR define('LOGIN_TYPE_FB', '2');
defined('LOGIN_TYPE_GOOGLE')	OR define('LOGIN_TYPE_GOOGLE', '3');

defined('URL_GOOGLE_IMG')		OR define('URL_GOOGLE_IMG', 'https://storage.googleapis.com/rapaq-image/');

/* prod
defined('SPGATEWAY_MERCHANTID')		OR define('SPGATEWAY_MERCHANTID', 'MS318956025');
defined('SPGATEWAY_HASHKEY')		OR define('SPGATEWAY_HASHKEY', '5s5fCFbTMrMmDoZVGLWdVVrT4UwxPumU');
defined('SPGATEWAY_HASHIV')			OR define('SPGATEWAY_HASHIV', 'Wr9y6ksTMffpDflj');
*/

// test
defined('SPGATEWAY_MERCHANTID')		OR define('SPGATEWAY_MERCHANTID', 'MS13802296');
defined('SPGATEWAY_HASHKEY')		OR define('SPGATEWAY_HASHKEY', 'NdCAzN9NasJBdSUXSyeYadYciJwSBYi6');
defined('SPGATEWAY_HASHIV')			OR define('SPGATEWAY_HASHIV', 'XUgwyj62N7a99CKZ');

// project
defined('PROJECT_STATUS_1_SEND')			OR define('PROJECT_STATUS_1_SEND', '1');
defined('PROJECT_STATUS_1_FAIL')			OR define('PROJECT_STATUS_1_FAIL', '2');
defined('PROJECT_STATUS_1_SUCCESS')			OR define('PROJECT_STATUS_1_SUCCESS', '3');
defined('PROJECT_STATUS_2_SEND')			OR define('PROJECT_STATUS_2_SEND', '4');
defined('PROJECT_STATUS_2_FAIL')			OR define('PROJECT_STATUS_2_FAIL', '5');
defined('PROJECT_STATUS_2_SUCCESS')			OR define('PROJECT_STATUS_2_SUCCESS', '6');
define('JSON_PORJECT_STATUS',json_encode(array(
	PROJECT_STATUS_1_SEND		=> '第1階段審查中',
	PROJECT_STATUS_1_FAIL		=> '第1階段審查失敗',
	PROJECT_STATUS_1_SUCCESS	=> '第1階段審查成功',
	PROJECT_STATUS_2_SEND		=> '第2階段審查中',
	PROJECT_STATUS_2_FAIL		=> '第2階段審查失敗',
	PROJECT_STATUS_2_SUCCESS	=> '第2階段審查成功'
)));

defined('SOURCE_QGOODS')		OR define('SOURCE_QGOODS', '1');
defined('SOURCE_QMAKER')		OR define('SOURCE_QMAKER', '2');

defined('PAYMENT_ORDER_INIT')    OR define('PAYMENT_ORDER_INIT', '0');
defined('PAYMENT_INIT')        OR define('PAYMENT_INIT', '1');
defined('PAYMENT_SUCCESS')    OR define('PAYMENT_SUCCESS', '2');
defined('PAYMENT_FAIL')        OR define('PAYMENT_FAIL', '3');
defined('PAYMENT_EXPIRE')    OR define('PAYMENT_EXPIRE', '4');

define('JSON_PAYMENT_STATUS',json_encode(array(
    PAYMENT_ORDER_INIT    => '訂單成立',
    PAYMENT_INIT        => '交易成立',
    PAYMENT_SUCCESS        => '交易成功',
    PAYMENT_FAIL        => '交易失敗',
    PAYMENT_EXPIRE        => '交易逾期'
)));