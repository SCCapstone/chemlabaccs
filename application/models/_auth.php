<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Authentication model
 */
class _Auth extends CI_Model {
    
    // table name
    private $table = '';

    /**
     * Authentication model construct
     */
    public function __construct() {

        parent::__construct();
        
        // get table name
        $this->table = $this->config->item('table_users');
        
    }
    
    /**
     * Creates a user
     * 
     * @param object $user
     * @return boolean
     */
    public function create_user($user) {
        
        unset($user->password);
        unset($user->passwordconf);
        
        $this->db->insert($this->table, $user);
        
        // was it inserted?
        return $this->db->affected_rows() == 1;
        
    }
    
    /**
     * Gets a user
     * 
     * @param string $username
     * @return object
     */
    public function get_user($user_name) {
        
        $this->db->select('*')
            ->from($this->table)
            ->where('email', $user_name);
        
        $query = $this->db->get(); 
        
        if ($query->num_rows() == 1) {
            
            return $query->row();
            
        }
        
        return NULL;
        
    }
    
    public function get_user_name($id) {
        
        $where = array("id" => $id);
        
        $query = $this->db->get_where($this->table, $where);
        
        if ($query->num_rows == 1) {
            $user_name = String($query->row()->email);
            return $user_name->substring(0, $user_name->indexOf("@"));
        }
        
        return NULL;
        
    }
    
    public function get_user_email($id) {
        
        $users = $this->db->get('users');
        
        if ($users->num_rows() > 0) {
            foreach ($users->result() as $usrRow) {
                if($usrRow->id == $id) {
                    return $usrRow->email;
                }
            }
        }
        
        return "";
    }
    
        public function get_admin($secid) {
        
        $sections = $this->db->get('section');
        
        if ($sections->num_rows() > 0) {
            foreach ($sections->result() as $secRow) {
                if($secRow->id == $secid) {
                    return $secRow->admin_id;
                }
            }
        }
        
        return "";
    }
    
    public function get_user_theme($id) {
        
        $where = array("id" => $id);
        
        $query = $this->db->get_where($this->table, $where);
        
        if ($query->num_rows() == 1) {
            return $query->row()->theme;
        }
        
        return NULL;
        
    }
    
    public function set_user_theme($id, $theme) {
        
        $where = array("id" => $id);
        
        $data = array(
            "theme" => $theme
        );
        
        $this->db->where("id", $id);
        $this->db->update($this->table, $data);
        
        return $this->db->affected_rows() == 1;
        
    }

    public function get_level($id) {
        
        $where = array("id" => $id);
        
        $query = $this->db->get_where($this->table, $where);
        
        if ($query->num_rows == 1) {
            $level = String($query->row()->userlvl);
            return $level;
        }
        
        return NULL;
    }
    
}