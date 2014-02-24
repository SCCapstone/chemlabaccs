<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Authentication model
 */
class _Section extends CI_Model {
    
    // table name
    private $table = '';

    /**
     * Section model construct
     */
    public function __construct() {

        parent::__construct();
        
        // get table name
        $this->table = $this->config->item('table_lab_user');
        
    }
    
    
    public function join_section($userSection) {
             
        $this->db->insert($this->table, $userSection);
        
        // was it inserted?
        return $this->db->affected_rows() == 1;
        
    }
    
    
}