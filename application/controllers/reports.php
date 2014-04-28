<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends CI_Controller {
    
    public function __construct() {
        
        parent::__construct();
        
        $this->auth->required();
        
        $this->table->set_template(array (
            "table_open" => '<table class="table table-striped">'
        ));
        
    }
    
    public function mine() {
        
        $this->load->library('user_agent');
        
        $mines = $this->_accidents->mine();
        
        if (count($mines) == 0) {            
            $content = "No results found";            
        } else {
            if($this->agent->is_mobile()) {
                $content = generate_accident_listing_mobile($mines, array("show_report#" => true));
            }
            else {
                $content = generate_accident_listing($mines, array("show_report#" => true));
            }
        }
        
        $title = sprintf("My Accident Reports");

        $this->template->write("title", $title);
        $this->template->write("heading", $title);
        $this->template->write_view("content", "accidents/results", $content);
        $this->template->write("content", $content);
        $this->template->render();
        
    }
    
    public function user() {
        
        $mines = $this->_accidents->mine();
        
        if (count($mines) == 0) {            
            $content = "No results found";            
        } else {            
            if($this->agent->is_mobile()) {
                $content = generate_accident_listing_mobile($mines, array("show_report#" => true));
            }
            else {
                $content = generate_accident_listing($mines, array("show_report#" => true));
            }
        }
        
        $title = sprintf("My Accident Reports");

        $this->template->write("title", $title);
        $this->template->write("heading", $title);
        $this->template->write("content", $content);
        $this->template->render();
        
    }
    
//    public function export() {
//        
//        $csv = new CSVWriter();
//        
//        $this->db->select("*")
//                ->from("accidents")
//                ->order_by("revision_of", "ASC")
//                ->order_by("created", "DESC");
//        
//        $query = $this->db->get();
//        
//        $csv->addRecord(array(
//            "Accident ID",
//            "Section ID",
//            "Revision Of",
//            "Date",
//            "Time",
//            "Description",
//            "Severity",
//            "Root",
//            "Prevention",
//            "User ID",
//            "Modified By",
//            "Created"
//        ));
//        
//        foreach ($query->result() as $row) {
//            $csv->addRecord((array) $row);
//        }
//        
//        $csv->download();
//        
//    }
    
     public function export() {
         
         $csv = new CSVWriter();
         
         $secs = $this->_section->get_sections_ids();
  
         $search = $this->_accidents->search($secs);
         
         $accDetails = array();
         
         foreach($search as $res) {
             $accDetails[] = $this->_accidents->detail($res->id);
         }
        
        
        $csv->addRecord(array(
            "Accident ID",
            "Section",
            "Date",
            "Time",
            "Description",
            "Severity",
            "Root Cause",
            "Prevention",
            "Created By",
            "Modified By",
            "Created Time/Date"
        ));
        
        foreach ($accDetails as $acc) {
            
            
            
            $row = array($acc->id, $this->_section->get_name($acc->section_id), $acc->date, $acc->time, 
                $acc->description, $acc->severity, $acc->root, $acc->prevention,
                $this->_auth->get_user_name($acc->user), $this->_auth->get_user_name($acc->modified_by),
                $acc->created);
            
            $csv->addRecord((array) $row);
        }
        
        $csv->download();
         
     }
    

}