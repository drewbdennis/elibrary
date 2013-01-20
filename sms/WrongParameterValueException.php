<?php

/**
 * TextMagic SMS API wrapper
 * Wrong value for parameter exception
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
 * Wrong parameter value [value] for parameter [parameter name]
 * Error code: 10
 * 
 * PHP version 5
 *
 * @category SMS
 * @package  TextMagicSMS
 * @author   Fedyashev Nikita <nikita@realitydrivendeveloper.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @link     http://code.google.com/p/textmagic-sms-api-php/
 */

class WrongParameterValueException extends Exception
{
    /** 
     * Class constructor 
     * 
     */ 
    public function __construct() 
    { 
        /* call the super class Exception constructor */ 
        parent::__construct('Wrong parameter value exception', 0); 
    }     
    
    /** 
     * Called when the object is casted to a string.
     *  
     * @return string 
     */ 
    public function __toString() 
    { 
        return 'Wrong parameter value exception'; 
    }
}

?>