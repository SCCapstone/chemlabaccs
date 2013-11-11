<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Buildings model
 */
class _Buildings extends CI_Model {
    
    // table name
    private $table = '';

    /**
     * Buildings model construct
     */
    public function __construct() {

        parent::__construct();
        
        // get table name
        $this->table = $this->config->item('table_buildings');
        
    }
    
    public function all($extra) {
        
        $buildings = array();
        
        $query = $this->db->get($this->table);
        
        if ($extra == true) {
            $buildings[""] = "";
        }
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $buildings[$row->id] = $row->name;
            }
        }
        
        return $buildings;
        
    }

}