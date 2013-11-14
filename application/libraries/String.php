<?php

if (!function_exists("String")) {
    
    function String($str = "") {
        return new String($str);
    }
    
}

class StringIndexOutOfBoundsException extends Exception {
    
    public function __construct($index) {
        
        parent::__construct("String index out of range: " . $index, NULL, NULL);
        
    }
    
}

/**
 * A PHP wrapper class that implements Java-like String manipulation
 * 
 * @author Michael Scribellito <mscribellito@gmail.com>
 */
class String {
    
    private $hash = 0;

    private $value;

    public function __construct($value = "", $offset = NULL, $count = NULL) {
        
        if ($offset == NULL && $count == NULL) {
            
            $this->value = (string) $value;
            
        } else {
            
            if ($offset < 0) {
                throw new StringIndexOutOfBoundsException($offset);
            }
            
            if ($count < 0) {
                throw new StringIndexOutOfBoundsException($count);
            }
            
            if ($offset > strlen($value) - $count) {
                throw new StringIndexOutOfBoundsException($offset + $count);
            }
            
            $this->value = substr((string) $value, $offset, $count);
            
        }
        
    }
    
    public function __destruct() {
        
        unset($this->value);
        
    }

    public function charAt($index) {
        
        if ($index < 0 || $index >= $this->length()) {
            throw new StringIndexOutOfBoundsException($index);
        }
        
        return $this->value[$index];
        
    }
    
    public function charCodeAt($index) {
        
        if ($index < 0 || $index >= $this->length()) {
            throw new StringIndexOutOfBoundsException($index);
        }
        
        return ord($this->value[$index]);
        
    }

    public function compareTo($anotherString) {

        return strcmp($this->value, $anotherString);
        
    }

    public function compareToIgnoreCase($anotherString) {

        return strcasecmp($this->value, $anotherString);
        
    }

    public function concat($str) {
        
        if (func_num_args() == 1) {
            return new String($this->value . $str);
        }
        
        $value = $this->value;
        
        for ($i = 0; $i < func_num_args(); $i++) {
            $value .= func_get_arg($i);
        }
        
        return new String($value);
        
    }

    public function contains($str) {

        return $this->indexOf($str) >= 0;
        
    }

    public function endsWith($suffix) {
        
        return $this->matches("/" . preg_quote($suffix) . "$/");
        
    }

    public function equals($anotherString) {

        return $this->compareTo($anotherString) == 0;
        
    }

    public function equalsIgnoreCase($anotherString) {

        return $this->compareToIgnoreCase($anotherString) == 0;
        
    }
    
    public static function format($format) {
        
        if (func_num_args() == 1) {
            return new String($format);
        }
        
        return new String(call_user_func_array("sprintf", func_get_args()));
        
    }
    
    public function hashCode() {
        
        $h = $this->hash;
        
        if ($h == 0 && $this->length() > 0) {
            for ($i = 0; $i < $this->length(); $i++) {
                $h = (int) (31 * $h + $this->charCodeAt($i)); //& 0xffffffff;
            }
            $this->hash = $h;
        }
        
        return $h;
        
    }

    public function indexOf($str, $fromIndex = NULL) {    
        
        if ($fromIndex < 0 || $fromIndex >= $this->length()) {
            $fromIndex = 0;
        }
        
        if ($fromIndex == NULL) {
            return strpos($this->value, $str);
        } else {
            return strpos($this->value, $str, $fromIndex);
        }
        
    }

    public function isEmpty() {

        return $this->length() == 0;
        
    }

    public function lastIndexOf($str, $fromIndex = NULL) {
        
        if (abs($fromIndex) >= $this->length()) {
            $fromIndex = 0;
        }
        
        if ($fromIndex == NULL) {
            return strrpos($this->value, $str);
        } else {
            return strrpos($this->value, $str, $fromIndex);
        }
        
    }

    public function length() {

        return strlen($this->value);
        
    }

    public function matches($regex, & $matches = NULL) {
        
        return preg_match($regex, $this->value, $matches) == 1;
        
    }
    
    public function regionMatches($toffset, $other, $ooffset, $len, $ignoreCase = false) {
        
        $t = $this->substring($toffset, $toffset + $len);
        
        $o = new String($other);
        $o = $o->substring($ooffset, $ooffset + $len);
        
        if ($ignoreCase == false) {
            return $t->equals($o);
        }
        
        return $t->equalsIgnoreCase($o);
        
    }

    public function replace($old, $new) {

        return new String(str_replace($old, $new, $this->value));
        
    }

    public function replaceAll($regex, $replacement) {
        
        return new String(preg_replace($regex, $replacement, $this->value));
        
    }

    public function replaceFirst($regex, $replacement) {
        
        return new String(preg_replace($regex, $replacement, $this->value, 1));
        
    }
    
    public function reverse() {
        
        return new String(strrev($this->value));
        
    }

    public function split($regex, $limit = NULL) {
        
        if ($limit == NULL) {
            return preg_split($regex, $this->value);
        } else {
            return preg_split($regex, $this->value, (int) $limit);
        }
        
    }

    public function startsWith($prefix) {
        
        return $this->matches("/^" . preg_quote($prefix) . "/");
        
    }
    
    public function substring($beginIndex, $endIndex = NULL) {        
        
        if ($endIndex == NULL) {
            
            if ($beginIndex < 0) {
                throw new StringIndexOutOfBoundsException($beginIndex);
            }
            
            $subLen = $this->length() - $beginIndex;
            if ($subLen < 0) {
                throw new StringIndexOutOfBoundsException($subLen);
            }
            
            if ($beginIndex == 0) {
                return $this;
            } else {
                return new String($this->value, $beginIndex, $subLen);
            }
                    
        } else {
            
            if ($beginIndex < 0) {
                throw new StringIndexOutOfBoundsException($beginIndex);
            }
            
            if ($endIndex > $this->length()) {
                throw new StringIndexOutOfBoundsException($endIndex);
            }
            
            $subLen = $endIndex - $beginIndex;
            if ($subLen < 0) {
                throw new StringIndexOutOfBoundsException($subLen);
            }
            
            if ($beginIndex == 0 && $endIndex == $this->length()) {
                return $this;
            } else {
                return new String($this->value, $beginIndex, $subLen);
            }
            
        }
        
    }
    
    public function toCharArray() {
        
        return (array) $this->value;
        
    }

    public function toLowerCase() {

        return new String(strtolower($this->value));
        
    }

    public function toUpperCase() {

        return new String(strtoupper($this->value));
        
    }

    public function trim() {

        return new String(trim($this->value));
        
    }
    
    public function trimLeft() {

        return new String(ltrim($this->value));
        
    }
    
    public function trimRight() {

        return new String(rtrim($this->value));
        
    }

    public function value($value = "") {
        
        if ($value != "") {
            $this->value = (string) $value;
            return $this;
        }

        return $this->value;
        
    }

    public function __toString() {

        return (string) $this->value;
        
    }

}

/* End of file String.php */