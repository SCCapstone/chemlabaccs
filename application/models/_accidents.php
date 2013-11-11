<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Accidents model
 */
class _Accidents extends CI_Model {
    
    // table name
    private $table = '';

    /**
     * Accidents model construct
     */
    public function __construct() {

        parent::__construct();
        
        // get table name
        $this->table = $this->config->item('table_accidents');
        
    }
    
    public function add($record) {
        
        $record->user = $this->auth->get_user_id();
        
        $this->db->insert($this->table, $record);
        
        return $this->db->affected_rows() == 1;
        
    }
    
    public function detail($id) {
        
        $where = array("id" => $id);
        
        $query = $this->db->get_where($this->table, $where);
        
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        
        return NULL;
        
    }

}