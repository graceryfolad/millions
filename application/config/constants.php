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
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
// application constants
defined('ACCOUNT_ACTIVE') OR define('ACCOUNT_ACTIVE', 100); // active account
defined('ACCOUNT_INACTIVE') OR define('ACCOUNT_INACTIVE', 105); // inactive account
defined('ACCOUNT_BLOCK') OR define('ACCOUNT_BLOCK', 120); // Blocked account
// order status
defined('ORDER_SUCCESS') OR define('ORDER_SUCCESS', 500); // order was successful
defined('ORDER_FAILED') OR define('ORDER_FAILED', 505); // order failed
defined('PAYMENT_PENDING') OR define('PAYMENT_PENDING', 510); // payment not completed
defined('INSUFFICIENT_CREDIT') OR define('INSUFFICIENT_CREDIT', 515); // there is no enough credit in wallet
//airvend api constants
defined('API_URL') OR define('API_URL', "http://api.airvendng.net"); // airvend api url
defined('API_EMAIL') OR define('API_EMAIL', "virtuousf2000@gmail.com"); // airvend api url
defined('API_PASSWORD') OR define('API_PASSWORD', 1234); // airvend api url
// user types
defined('CUSTOMER') OR define('CUSTOMER', 700); // customer
defined('VENDOR') OR define('VENDOR', 730); // vendor
defined('ADMIN') OR define('ADMIN', 750); // admin user
defined('MERCHANT') OR define('MERCHANT', 760); // merchant

defined('MERCHANT_APPROVED') OR define('MERCHANT_APPROVED', 800); // merchant approved
defined('MERCHANT_DECLINED') OR define('MERCHANT_DECLINED', 810); // merchant Declined
defined('MERCHANT_ACTIVE') OR define('MERCHANT_ACTIVE', 820); // merchant ACTIVE
defined('MERCHANT_BLOCKED') OR define('MERCHANT_BLOCKED', 800); // merchant BLOCKED

defined('BATCH_ACTIVE') OR define('BATCH_ACTIVE', 1); // BATCH ACTIVE
defined('BATCH_INACTIVE') OR define('BATCH_INACTIVE', 0); // BATCH ACTIVE
defined('BATCH_USED') OR define('BATCH_USED', 2); // BATCH ACTIVE

defined('PIN_REQUEST_PENDING') OR define('PIN_REQUEST_PENDING', 905); // BATCH ACTIVE
defined('PIN_REQUEST_APPROVED') OR define('PIN_REQUEST_APPROVED', 900); // BATCH ACTIVE

defined('GROUP_OPEN') OR define('GROUP_OPEN', 600); // GROUP OPENED
defined('GROUP_CLOSED') OR define('GROUP_CLOSE', 610); // GROUP OPENED
defined('GROUP_RUNNING') OR define('GROUP_RUNNING', 620); // GROUP OPENED

defined('FREQ_DAILY') OR define('FREQ_DAILY', 10); // daily
defined('FREQ_WEEKLY') OR define('FREQ_WEEKLY', 30); // weekly
defined('FREQ_MONTHLY') OR define('FREQ_MONTHLY', 50); // daily