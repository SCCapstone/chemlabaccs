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
        
        $mines = $this->_accidents->mine();
        
        if (count($mines) == 0) {            
            $content = "No results found";            
        } else {
            $content = generate_accident_listing($mines, array("show_report#" => true));
        }
        
        $title = sprintf("My Accident Reports");

        $this->template->write("title", $title);
        $this->template->write("heading", $title);
        $this->template->write("content", $content);
        $this->template->render();
        
    }
    
    public function user() {
        
        $mines = $this->_accidents->mine();
        
        if (count($mines) == 0) {            
            $content = "No results found";            
        } else {
            $content = generate_accident_listing($mines, array("show_report#" => true));
        }
        
        $title = sprintf("My Accident Reports");

        $this->template->write("title", $title);
        $this->template->write("heading", $title);
        $this->template->write("content", $content);
        $this->template->render();
        
    }
    
    public function export() {
        
        $csv = new CSVWriter();
        
        $this->db->select("*")
                ->from("accidents")
                ->order_by("revision_of", "ASC")
                ->order_by("created", "DESC");
        
        $query = $this->db->get();
        
        $csv->addRecord(array(
            "ID",
            "Revision Of",
            "Date",
            "Time",
            "Building",
            "Room",
            "Description",
            "Severity",
            "Root",
            "Prevention",
            "User",
            "Modified By",
            "Created"
        ));
        
        foreach ($query->result() as $row) {
            $csv->addRecord((array) $row);
        }
        
        $csv->download();
        
    }

}