<?php

/**
 * Generates a CSV
 * 
 * @author Michael Scribellito <mscribellito@gmail.com>
 */
class CSVWriter {

    // always surround fields with quotes
    private $alwaysDelimit = false;
    
    // usually comma delimited    
    private $delimiter = ",";
    
    // may be a LF (0x0A) or a CRLF (0x0D0A)
    private $newLine = "\n";
    
    // holds all the records
    private $records;

    /**
     * Constructs an empty CSV writer
     */
    public function __construct() {

        $this->clear();
        
    }

    /**
     * Adds a record
     * 
     * @param array $record
     */
    public function addRecord(array $record) {

        // loop through all fields and prepare them
        foreach ($record as $index => $field) {
            $record[$index] = $this->prepare($field);
        }

        // add record
        $this->records[] = $record;
        
    }

    /**
     * Adds an array of records
     * 
     * @param array $records
     */
    public function addRecords(array $records) {

        // add all records
        foreach ($records as $record) {
            $this->addRecord($record);
        }
        
    }

    /**
     * Clears records
     */
    public function clear() {

        $this->records = array();
        
    }
    
    /**
     * Downloads the CSV
     * 
     * @return void
     */
    public function download() {
        
        if (headers_sent()) {
            return;
        }
        
        $csv = $this->generate();
        
        header("Content-Type: text/csv");
        header("Content-Length: " . strlen($csv));
        header("Content-Disposition: attachment; filename=" . time() . ".csv");
        header("Cache-Control: no-cache");
        
        echo $csv;
        
    }

    /**
     * Generates the CSV
     * 
     * @return string
     */
    private function generate() {

        $csv = "";

        // are there any records?
        if (count($this->records) > 0) {

            // loop through all the records
            foreach ($this->records as $record) {

                $csv .= implode($this->delimiter, $record) . $this->newLine;
                
            }
            
        }

        $this->clear();

        return $csv;
        
    }
    
    /**
     * Outputs the CSV
     * 
     * @return void
     */
    public function output() {
        
        if (headers_sent()) {
            return;
        }
        
        $csv = $this->generate();
        
        header("Content-Type: text/plain");
        header("Content-Length: " . strlen($csv));
        header("Content-Disposition: inline; filename=" . time() . ".csv");
        
        echo $csv;
        
    }

    /**
     * Prepares a field for the CSV
     * 
     * @param string $field
     * @return string
     */
    private function prepare($field) {

        $sanitize = false;

        // embedded commas
        if (preg_match("/,/", $field)) {
            $sanitize = true;
        }
        // embedded double quotes
        if (preg_match("/\"/", $field)) {
            $sanitize = true;
            $field = str_replace("\"", "\"\"", $field);
        }
        // embedded line breaks
        if (preg_match("/[\r\n]/", $field)) {
            $sanitize = true;
        }

        // surround by double quotes
        if ($sanitize == true || $this->alwaysDelimit == true) {
            $field = "\"" . $field . "\"";
        }

        return $field;
        
    }
    
    /**
     * Sets whether or not fields are always delimited (surrounded with double
     * quotes)
     * 
     * @param boolean $delimit
     */
    public function setAlwaysDelimit($delimit) {
        
        $this->alwaysDelimit = (bool) $delimit;
        
    }

    /**
     * Sets the field delimiter
     * 
     * @param string $delimiter
     */
    public function setDelimiter($delimiter) {

        $this->delimiter = (string) $delimiter;
        
    }

    /**
     * Sets the new line sequence
     * 
     * @param string $newLine
     */
    public function setNewLine($newLine) {

        $this->newLine = (string) $newLine;
        
    }

    /**
     * Returns the CSV string
     * 
     * @return string
     */
    public function __toString() {

        return $this->generate();
        
    }

}
