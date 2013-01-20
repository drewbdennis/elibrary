<?php

/**
 * TextMagic SMS API wrapper
 * Disabled account exception
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


/**
 * Your account has been disabled
 * Error code: 13
 * 
 * PHP version 5
 *
 * @category SMS
 * @package  TextMagicSMS
 * @author   Fedyashev Nikita <nikita@realitydrivendeveloper.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @link     http://code.google.com/p/textmagic-sms-api-php/
 */

class DisabledAccountException extends Exception
{
    /** 
     * Class constructor 
     * 
     */ 
    public function __construct() 
    { 
        /* call the super class Exception constructor */ 
        parent::__construct('Your account has been disabled exception', 0); 
    }     
    
    /** 
     * Called when the object is casted to a string. 
     * 
     * @return string 
     */ 
    public function __toString() 
    { 
        return 'Your account has been disabled exception'; 
    }
}

?>