<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accidents extends CI_Controller {
    
    public function __construct() {
        
        parent::__construct();
        
        $this->auth->required();
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $this->table->set_template(array (
            "table_open" => '<table class="table table-striped">'
        ));
        
    }
    
    public function date_check($date) {
        
        if (valid_date($date) == false) {
            $this->form_validation->set_message("date_check", "%s is not valid");
            return false;
        }
        
        return true;
        
    }
    
    public function time_check($time) {
        
        if (valid_time($time) == false) {
            $this->form_validation->set_message("time_check", "%s is not valid");
            return false;
        }
        
        return true;
        
    }

    public function add($action = "") {
        
        $data = array();
        $data["error"] = NULL;
        
        $this->form_validation->set_rules('date', 'Date', 'required|callback_date_check');
        $this->form_validation->set_rules('time', 'Time', 'required|callback_time_check');
        $this->form_validation->set_rules('building', 'Building', 'required');
        $this->form_validation->set_rules('room', 'Room', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('severity', 'Severity', 'required');
        $this->form_validation->set_rules('root', 'Root', 'required');
        $this->form_validation->set_rules('prevention', 'Prevention', 'required');

        if ($this->form_validation->run() && $action == "save") {
            
            $new = new stdClass;
            
            if ($this->input->post("revision_of")) {
                $new->revision_of = $this->input->post("revision_of");
            } else {
                $new->revision_of = 0;
            }
            $new->date = date_human2mysql($this->input->post("date"));
            $new->time = time_human2mysql($this->input->post("time"));
            $new->building = $this->input->post("building");
            $new->room = $this->input->post("room");
            $new->description = $this->input->post("description");
            $new->severity = $this->input->post("severity");
            $new->root = $this->input->post("root");
            $new->prevention = $this->input->post("prevention");
            
            if ($this->_accidents->add($new)) {
                $this->flash->success("Report successfully added.");
                redirect();
            } else {
                $data["error"] = "Error adding report. Please Try again.";
            }
            
        }

        $this->template->write("title", "Add Accident Report");
        $this->template->write("heading", "Add Accident Report");
        $this->template->write_view("content", "accidents/add", $data);
        
        $this->template->render();
            
    }
    
    public function detail($id) {
        
        $id = (int) $id;
        
        $data = array();
        
        $details = $this->_accidents->detail($id);
        
        if ($details != NULL) {
            $data["details"] = $details;
        } else {
            redirect("dashboard");
        }

        $this->template->write("title", "Detailed Accident Report");
        $this->template->write("heading", "Detailed Accident Report");
        $this->template->write_view("content", "accidents/detail", $data);
        
        $this->template->render();
        
    }
    
    public function mine() {
        
        $mines = $this->_accidents->mine();
        
        if (count($mines) == 0) {            
            $content = "No results found";            
        } else {
            $content = $this->display($mines, array("show_report#" => true));
        }
        
        $title = sprintf("My Accident Reports");

        $this->template->write("title", $title);
        $this->template->write("heading", $title);
        $this->template->write("content", $content);
        $this->template->render();
        
        
    }
    
    public function results() {
        
        $search = $this->_accidents->search();
        
        if (count($search) == 0) {            
            $content = "No results found";            
        } else {
            $content = $this->display($search, array("show_report#" => true));
        }

        $this->template->write("title", "Search Results");
        $this->template->write("heading", "Search Results");
        $this->template->write("content", $content);
        $this->template->render();
        
    }
    
    private function display($accidents, $show = array()) {
        
        $show = array_merge(array(
            "show_report#" => false,
            "show_detail" => true,
            "show_revisions" => true,
        ), $show);
		
        $headings = array(
            "Date/Time",
            "Building",
            "Room",
            "Severity",
            "Enter User",
            "Created On",
            "Actions"
        );
			
        if ($show["show_report#"]) {
                array_unshift($headings, "Report #");
        }
        
        $this->table->set_heading($headings);
        
        foreach ($accidents as $acc) {
            
            $actions = array();
            
            if ($show["show_detail"]) {
                $actions[] = anchor("accidents/detail/" . $acc->id, '<span class="glyphicon glyphicon-eye-open"></span> Details', array(
                    "class" => "btn btn-default"
                ));
            }
            
            if ($show["show_revisions"]) {
                $actions[] = anchor("accidents/revisions/" . $acc->revision_of, '<span class="glyphicon glyphicon-list-alt"></span> Revisions', array(
                    "class" => "btn btn-default"
                ));
            }
            
            $user = String($acc->email);
			
            $row = array(
                date_mysql2human($acc->date) . " " . time_mysql2human($acc->time),
                $acc->name,
                $acc->room,
                severity_scale($acc->severity),
                $user->substring(0, $user->indexOf("@")),
                date("m/d/Y g:i a", strtotime($acc->created)),
                implode(' ', $actions)
            );
			
            if ($show["show_report#"]) {
                array_unshift($row, sprintf("%04d", $acc->revision_of));
            }

            $this->table->add_row($row);

        }
        
        return $this->table->generate();        
        
    }
    
    public function revisions($id) {
        
        $revisions = $this->_accidents->revisions($id);
        
        if (count($revisions) == 0) {            
            $content = "No results found";            
        } else {
            $content = $this->display($revisions, array("show_revisions" => false));
        }
        
        $title = sprintf("Revisions for Accident Report ID:%d", $revisions[0]->revision_of);

        $this->template->write("title", $title);
        $this->template->write("heading", $title);
        $this->template->write("content", $content);
        $this->template->render();        
        
    }
    
    public function search($action = "") {
        
        $data = array();

        $this->template->write("title", "Search Accident Reports");
        $this->template->write("heading", "Search Accident Reports");
        $this->template->write_view("content", "accidents/search", $data);
        
        $this->template->render();
        
    }

}