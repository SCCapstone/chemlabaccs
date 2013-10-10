<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Flash {
    
    private $CI;
    
    const DANGER = "_danger";
    const WARNING = "_warning";
    const SUCCESS = "_success";
    const INFORMATION = "_information";
    
    public function __construct() {
        
        $this->CI =& get_instance();
        
    }
    
    public function danger($value = NULL) {
        
        if ($value == NULL) return $this->get(self::DANGER);
        
        $this->set(self::DANGER, $value);
        
    }
    
    public function warning($value = NULL) {
        
        if ($value == NULL) return $this->get(self::WARNING);
        
        $this->set(self::WARNING, $value);
        
    }
    
    public function success($value = NULL) {
        
        if ($value == NULL) return $this->get(self::SUCCESS);
        
        $this->set(self::SUCCESS, $value);
        
    }
    
    public function information($value = NULL) {
        
        if ($value == NULL) return $this->get(self::INFORMATION);
        
        $this->set(self::INFORMATION, $value);
        
    }
    
    public function set($name, $value) {
        
        $this->CI->session->set_flashdata($name, $value);
        
    }
    
    public function get($name) {
        
        return $this->CI->session->flashdata($name);
        
    }
    
    public function keep($name) {
        
        $this->CI->session->keep_flashdata($name);
        
    }
    
    public function __toString() {
        
        $type = "";
        $msg = "";
        
        if ($this->get(self::DANGER)) {
            $type = "alert-danger";
            $msg = $this->get(self::DANGER);
        } else if ($this->get(self::WARNING)) {
            $type = "alert-warning";
            $msg = $this->get(self::WARNING);
        } else if ($this->get(self::SUCCESS)) {
            $type = "alert-success";
            $msg = $this->get(self::SUCCESS);
        } else if ($this->get(self::INFORMATION)) {
            $type = "alert-info";
            $msg = $this->get(self::INFORMATION);
        } else {
            return "";
        }
        
        return sprintf("<div class=\"alert %s\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>%s </div>", $type, $msg);
        
    }
    
}
