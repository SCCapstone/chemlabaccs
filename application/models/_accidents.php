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
    
    public function search() {
        
        $results = array();
        
        $this->db->select("accidents.id, revision_of, date, time, buildings.name, room,
            description, severity, root, prevention, users.email, created");
        $this->db->from("accidents");
        $this->db->join("buildings", "accidents.building = buildings.id");
        $this->db->join("users", "accidents.user = users.id");
                
        if ($this->input->post("start_date") && $this->input->post("end_date")) {
            $this->db->where("date >=", date_human2mysql($this->input->post("start_date")));
            $this->db->where("date <=", date_human2mysql($this->input->post("end_date")));
        }
        
        if ($this->input->post("start_time") && $this->input->post("end_time")) {
            $this->db->where("time >=", time_human2mysql($this->input->post("start_time")));
            $this->db->where("time <=", time_human2mysql($this->input->post("end_time")));
        }
        
        if ($this->input->post("building")) {
            $this->db->where("building", $this->input->post("building"));
        }
        
        if ($this->input->post("room")) {
            $this->db->where("room", $this->input->post("room"));
        }
        
        if ($this->input->post("description")) {
            $this->db->like("description", $this->input->post("description"));
        }
        
        if ($this->input->post("severity")) {
            if (count($this->input->post("severity")) > 0) {
                $values = array();
                foreach ($this->input->post("severity") as $severity) {
                    $values[] = $severity;
                }
                $this->db->where_in("severity", $values);
            }
        }
        
        if ($this->input->post("root")) {
            $this->db->like("root", $this->input->post("root"));
        }
        
        if ($this->input->post("prevention")) {
            $this->db->like("prevention", $this->input->post("prevention"));
        }
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $results[] = $row;
            }
        }
        
        return $results;        
        
    }

}