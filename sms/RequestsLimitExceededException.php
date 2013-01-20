<?php

/**
 * TextMagic SMS API wrapper
 * Daily requests limit exception
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
 * Your daily API usage limit is reached
 * Error code: 11
 * 
 * PHP version 5
 *
 * @category SMS
 * @package  TextMagicSMS
 * @author   Fedyashev Nikita <nikita@realitydrivendeveloper.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @link     http://code.google.com/p/textmagic-sms-api-php/
 */

class RequestsLimitExceededException extends Exception
{
    /** 
     * Class constructor 
     * 
     */ 
    public function __construct() 
    { 
        /* call the super class Exception constructor */ 
        parent::__construct('Daily requests limit exceeded exception', 0); 
    }     
    
    /** 
     * Called when the object is casted to a string.
     *  
     * @return string 
     */ 
    public function __toString() 
    { 
        return 'Daily requests limit exceeded exception'; 
    }
}

?>