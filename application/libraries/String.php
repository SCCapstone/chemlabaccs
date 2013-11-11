<?php

// check if "String()" exists...
if (!function_exists("String")) {
    
    /**
     * Creates a String object
     * 
     * @param type $str
     * @return String
     */
    function String($str = "") {
        // is it a String already?
        if ($str instanceof String) {
            return $str;
        }
        return new String($str);
    }
    
}

/**
 * A PHP wrapper class that implements Java-like String manipulation
 * 
 * @author Michael Scribellito <mscribellito@gmail.com>
 */
class String {

    // the value (buffer) of the string
    private $value;

    /**
     * Initializes a newly created String object so that it represents a
     * character sequence.
     * 
     * @param string $value
     */
    public function __construct($original = "") {

        $this->value = (string) $original;
        
    }
    
    /**
     * Destroys a String object
     */
    public function __destruct() {
        
        unset($this->value);
        
    }

    /**
     * Returns the char value at the specified index.
     * 
     * @param int $index
     * @return string
     * @throws Exception if the index argument is negative or not less than the
     * length of this string.
     */
    public function charAt($index) {
        
        return $this->substring($index, $index + 1)->value;
        
    }
    
    /**
     * Returns the character code at the specified index.
     * 
     * @param int $index
     * @return string
     * @throws Exception if the index argument is negative or not less than the
     * length of this string.
     */
    public function charCodeAt($index) {
        
        return ord($this->substring($index, 1)->value);
        
    }

    /**
     * Compares two strings lexicographically.
     * 
     * @param string $str
     * @return int
     */
    public function compareTo($anotherString) {

        return strcmp($this->value, $anotherString);
        
    }

    /**
     * Compares two strings lexicographically, ignoring case differences.
     * 
     * @param string $str
     * @return int
     */
    public function compareToIgnoreCase($anotherString) {

        return strcasecmp($this->value, $anotherString);
        
    }

    /**
     * Concatenates the specified string(s) to the end of this string.
     * 
     * @param string $str
     * @return String
     */
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

    /**
     * Returns true if and only if this string contains the specified sequence
     * of char values.
     * 
     * @param string $str
     * @return boolean
     */
    public function contains($str) {

        return $this->indexOf($str) >= 0;
        
    }

    /**
     * Tests if this string ends with the specified suffix.
     * 
     * @param string $suffix
     * @return boolean
     */
    public function endsWith($suffix) {
        
        $suffix = "/" . preg_quote($suffix) . "$/";

        return preg_match($suffix, $this->value) == 0;
        
    }

    /**
     * Compares this string to the specified object.
     * 
     * @param string $str
     * @return boolean
     */
    public function equals($anotherString) {

        return $this->compareTo($anotherString) == 0;
        
    }

    /**
     * Compares this String to another String, ignoring case considerations.
     * 
     * @param string $str
     * @return boolean
     */
    public function equalsIgnoreCase($anotherString) {

        return $this->compareToIgnoreCase($anotherString) == 0;
        
    }
    
    /**
     * Returns a formatted string using the specified format string and
     * arguments.
     * 
     * @param string $format
     * @return String
     */
    public static function format($format) {
        
        if (func_num_args() == 1) {
            return new String($format);
        }
        
        return new String(call_user_func_array("sprintf", func_get_args()));
        
    }

    /**
     * Returns the index within this string of the first occurrence of the
     * specified character.
     * 
     * @param string $str
     * @param int $fromIndex
     * @return int
     */
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

    /**
     * Returns true if, and only if, length() is 0.
     * 
     * @return boolean
     */
    public function isEmpty() {

        return $this->length() == 0;
        
    }

    /**
     * Returns the index within this string of the last occurrence of the
     * specified character.
     * 
     * @param string $str
     * @param int $fromIndex
     * @return int
     */
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

    /**
     * Returns the length of this string.
     * 
     * @return int
     */
    public function length() {

        return strlen($this->value);
        
    }

    /**
     * Tells whether or not this string matches the given regular expression.
     * 
     * @param string $pattern
     * @param array $matches
     * @return boolean
     */
    public function matches($regex, & $matches = NULL) {
        
        return preg_match($regex, $this->value, $matches) == 1;
        
    }
    
    /**
     * Tests if two string regions are equal.
     * 
     * @param int $toffset
     * @param string $other
     * @param int $ooffset
     * @param int $len
     * @param boolean $ignoreCase
     * @return boolean
     */
    public function regionMatches($toffset, $other, $ooffset, $len, $ignoreCase = false) {
        
        $t = $this->substring($toffset, $toffset + $len);
        
        $o = new String($other);
        $o = $o->substring($ooffset, $ooffset + $len);
        
        if ($ignoreCase == false) {
            return $t->equals($o);
        }
        
        return $t->equalsIgnoreCase($o);
        
    }

    /**
     * Returns a new string resulting from replacing all occurrences of old
     * in this string with new.
     * 
     * @param string $old
     * @param string $new
     * @return String
     */
    public function replace($old, $new) {

        return new String(str_replace($old, $new, $this->value));
        
    }

    /**
     * Replaces each substring of this string that matches the given regular
     * expression with the given replacement.
     * 
     * @param string $pattern
     * @param string $replacement
     * @return String
     */
    public function replaceAll($regex, $replacement) {
        
        return new String(preg_replace($regex, $replacement, $this->value));
        
    }

    /**
     * Replaces the first substring of this string that matches the given
     * regular expression with the given replacement.
     * 
     * @param string $pattern
     * @param string $replacement
     * @return String
     */
    public function replaceFirst($regex, $replacement) {
        
        return new String(preg_replace($regex, $replacement, $this->value, 1));
        
    }
    
    /**
     * Reverses the string
     * 
     * @return String 
     */
    public function reverse() {
        
        return new String(strrev($this->value));
        
    }

    /**
     * Splits this string around matches of the given regular expression.
     * 
     * @param string $pattern
     * @param int $limit
     * @return array
     */
    public function split($regex, $limit = NULL) {
        
        if ($limit == NULL) {
            return preg_split($regex, $this->value);
        } else {
            return preg_split($regex, $this->value, (int) $limit);
        }
        
    }

    /**
     * Tests if the substring of this string beginning at the specified index
     * starts with the specified prefix.
     * 
     * @param string $prefix
     * @return boolean
     */
    public function startsWith($prefix) {
        
        $prefix = "/^" . preg_quote($prefix) . "/";

        return preg_match($prefix, $this->value) == 0;
        
    }
    
    /**
     * Returns a new string that is a substring of this string.
     * 
     * @param int $beginIndex
     * @param int $endIndex
     * @return String
     * @throws Exception if the index argument is negative or not less than the
     * length of this string.
     */
    public function substring($beginIndex, $endIndex = NULL) {
        
        if ($beginIndex < 0) {
            throw new Exception("String index out of range: " . $beginIndex);
        }
        if ($endIndex > $this->length()) {
            throw new Exception("String index out of range: " . $endIndex);
        }
        if ($beginIndex > $endIndex) {
            throw new Exception("String index out of range: " . $endIndex - $beginIndex);
        }
        
        if ($endIndex == NULL) {
            return new String(substr($this->value, $beginIndex));
        } else if ($beginIndex == 0 && $endIndex == $this->length()) {
            return new String($this->value);
        } else {
            return new String(substr($this->value, $beginIndex, $endIndex - $beginIndex));
        }
        
    }
    
    /**
     * Converts this string to a new character array.
     * 
     * @return array
     */
    public function toCharArray() {
        
        return (array) $this->value;
        
    }

    /**
     * Converts all of the characters in this String to lower case.
     * 
     * @return String
     */
    public function toLowerCase() {

        return new String(strtolower($this->value));
        
    }

    /**
     * Converts all of the characters in this String to upper case.
     * 
     * @return String
     */
    public function toUpperCase() {

        return new String(strtoupper($this->value));
        
    }

    /**
     * Returns a copy of the string, with leading and trailing whitespace
     * omitted.
     * 
     * @return String
     */
    public function trim() {

        return new String(trim($this->value));
        
    }
    
    /**
     * Returns a copy of the string, with leading whitespace omitted.
     * 
     * @return String
     */
    public function trimLeft() {

        return new String(ltrim($this->value));
        
    }
    
    /**
     * Returns a copy of the string, with trailing whitespace omitted.
     * 
     * @return String
     */
    public function trimRight() {

        return new String(rtrim($this->value));
        
    }

    /**
     * Returns the value of the string.
     * 
     * @return string
     */
    public function value() {

        return $this->value;
        
    }

    /**
     * Returns a string representation of this object.
     * 
     * @return string
     */
    public function __toString() {

        return $this->value;
        
    }

}
