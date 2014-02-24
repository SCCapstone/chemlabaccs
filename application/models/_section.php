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
    
    public function get_sections() {
        
        $auth = new Auth();
        
        $userid = $auth->get_user_id();
        
        $result = array();
        
        $sectionQ = $this->db->get('section');
        $userLabQ = $this->db->get('lab_user');
        
        if ($sectionQ->num_rows() > 0 and $userLabQ->num_rows() > 0) {
            foreach ($sectionQ->result() as $secRow) {
                foreach ($userLabQ->result() as $usRow) {
                    if ($secRow->id == $usRow->section_id) {
                        $result[$secRow->id] = $secRow->name;
                    }
                }
    
            }
        }
        
        return $result;
        
    }
    
    
}