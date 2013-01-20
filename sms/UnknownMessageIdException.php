<?php

/**
 * TextMagic SMS API wrapper
 * Unknown message ID exception
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
 * Message with this id was not found.
 * Error code: 14
 * 
 * PHP version 5
 *
 * @category SMS
 * @package  TextMagicSMS
 * @author   Fedyashev Nikita <nikita@realitydrivendeveloper.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @link     http://code.google.com/p/textmagic-sms-api-php/
 */

class UnknownMessageIdException extends Exception
{
    /** 
     * Class constructor 
     * 
     */ 
    public function __construct() 
    { 
        /* call the super class Exception constructor */ 
        parent::__construct('Wrong message ID exception', 0); 
    }     
    
    /** 
     * Called when the object is casted to a string.
     *  
     * @return string 
     */ 
    public function __toString() 
    { 
        return 'Wrong message ID exception'; 
    }
}


?>