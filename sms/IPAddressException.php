<?php

/**
 * TextMagic SMS API wrapper
 * Not allowed IP address exception
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
 * IP address is not allowed
 * Error code: 8
 * 
 * PHP version 5
 *
 * @category SMS
 * @package  TextMagicSMS
 * @author   Fedyashev Nikita <nikita@realitydrivendeveloper.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @link     http://code.google.com/p/textmagic-sms-api-php/
 */

class IPAddressException extends Exception
{
    /** 
     * Class constructor 
     * 
     */ 
    public function __construct() 
    { 
        /* call the super class Exception constructor */ 
        parent::__construct('Not allowed IP address exception', 0); 
    }     
    
    /** 
     * Called when the object is casted to a string.
     *  
     * @return string 
     */ 
    public function __toString() 
    { 
        return 'Not allowed IP address exception'; 
    }
}

?>