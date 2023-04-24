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


/*
|--------------------------------------------------------------------------
| Image Dir
|--------------------------------------------------------------------------
|
*/

define('PAGENUMBER',15);
define('PAGESIZE',10);
define('PAGESIZE_15',15);
define('PAGESIZE_12',12);
define('ABS_PATH',$_SERVER['DOCUMENT_ROOT']);
define("THIS_DOMAIN","http://".$_SERVER['HTTP_HOST']);
define("_HTTP","http://");
define('NO_CONTENTS', "조회된 컨텐츠가 없습니다.");

/* 초기 세팅 */

define("SITE_NAME",	"insite");
define("SITE_DOMAIN",	"rocateerdev.co.kr");
define("SERVICE_NAME",'인사이트');
define("COOKIE_DOMAIN",	".rocateerdev.co.kr");
define('FILE_PATH',str_replace('/m','',str_replace('/m','',$_SERVER['DOCUMENT_ROOT'])));

/*smtp 메일 세팅*/
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USER', 'evescore.service@gmail.com');
define('SMTP_PASS', 'skocoaxvkolujalj');
define('SMTP_PORT', '465');
define('FROM_EMAIL', 'evescore.service@gmail.com');
define('FROM_NAME', '더프리다');

/*gcm 세팅*/
define("GCM_KEY_1",	"AAAAeDLmT8U:APA91bH3V2L2TcSXJzUSoy4452VSVaHVZabNKWMHHYMH9Lk7WNcjsGtESaSHi02eniRRWVXODOxh88ievBDTietortUxBi-7NOgWQXUoad8OsFe3FqfRch17KCCOy7r7ohPyWcBEb-29");//일반 키
define("GCM_KEY_2",	"");//일반 키 ios

/*네이버 SNS 로그인 설정*/
define('NAVER_CLIENT_ID', 'IIuaiOaY8rqfEfrtji2P'); //네이버 클라이언트 아이디
define('NAVER_Call_URL', 'https://www.whatskitchen.com/sns_add_info_join/login_null'); //네이버에서 설정한 callback url과 동일하게 설정
define('NAVER_SET_DAMAIN', 'https://www.whatskitchen.com'); //네이버에서 설정한 domain 과 동일하게 설정

/*카카오 SNS 로그인 설정*/
define('KAKAO_APP_KEY', '1c0591eb50224fe211f58257056fc998'); //카카오 로그인 앱키 JavaScript 키
