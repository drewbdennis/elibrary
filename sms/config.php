<?php

/**
 * TextMagic SMS API wrapper
 * 
 * PHP version 5
 * 
 * @category SMS
 * @package  TextMagicSMS
 * @author   Fedyashev Nikita <nikita@realitydrivendeveloper.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @link     http://code.google.com/p/textmagic-sms-api-php/
 * 
 */

define('SMS_QUEUE', 'q');
define('SMS_SCHEDULED_QUEUE', 's');
define('SMS_SENDING_ERROR', 'e');
define('SMS_ENROUTE', 'r');
define('SMS_ACKED', 'a');
define('SMS_DELIVERED', 'd');
define('SMS_BUFFERED', 'b');
define('SMS_FAILED', 'f');
define('SMS_UNKNOWN', 'u');
define('SMS_REJECTED', 'j');

$final_statuses = array(SMS_DELIVERED, SMS_FAILED, SMS_UNKNOWN, SMS_REJECTED);