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
        
        $success = $this->db->affected_rows() == 1;
        
        if ($record->revision_of == 0 && $success) {
            $insert_id = $this->db->insert_id();
            $this->db->where("id", $insert_id);
            $this->db->update($this->table, array("revision_of" => $insert_id));
        }
        
        return $success;
        
    }
    
    public function detail($id) {
        
        $where = array("id" => $id);
        
        $query = $this->db->get_where($this->table, $where);
        
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        
        return NULL;
        
    }
    
    public function mine() {
        
        $mines = array();
        
        $sql = sprintf("SELECT a.id, a.revision_of, a.`date`, a.`time`, buildings.name, a.room, a.description,
            a.severity, a.root, a.prevention, users.email, a.created
            FROM accidents a
            JOIN buildings ON a.building = buildings.id
            JOIN users ON a.user = users.id
            LEFT JOIN accidents b ON (a.revision_of = b.revision_of AND a.id < b.id)
            WHERE b.id IS NULL AND a.user = %d
            ORDER BY a.created DESC", $this->auth->get_user_id());
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $mines[] = $row;
            }
        }
        
        return $mines;
        
    }
    
    public function revisions($id) {
        
        $revisions = array();
        
        $sql = sprintf("SELECT a.id, a.revision_of, a.`date`, a.`time`, buildings.name, a.room, a.description,
            a.severity, a.root, a.prevention, users.email, a.created
            FROM accidents a
            JOIN buildings ON a.building = buildings.id
            JOIN users ON a.user = users.id
            WHERE revision_of = %d", $id);
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $revisions[] = $row;
            }
        }
        
        return $revisions;
        
    }

}