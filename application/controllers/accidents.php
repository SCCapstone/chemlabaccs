<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accidents extends CI_Controller {
    
    public function __construct() {
        
        parent::__construct();
        
        $this->auth->required();
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
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
                $new->revision_of = (int) $this->input->post("revision_of");
                $new->user = (int) $this->input->post("user");
                $new->modified_by = $this->auth->get_user_id();
            } else {
                $new->revision_of = 0;
                $new->user = $this->auth->get_user_id();
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
                redirect("dashboard/home");
            } else {
                $data["error"] = "Error adding report. Please Try again.";
            }
            
        }
        
        $title = "Add Accident Report";

        $this->template->write("title", $title);
        $this->template->write("heading", $title);
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
        
        $title = sprintf('<span class="label label-default">#%s</span> Accident Report Details', format_accident_report_number($details->revision_of));

        $this->template->write("title", 'Accident Report Details');
        $this->template->write("heading", $title);
        $this->template->write_view("content", "accidents/detail", $data);
        
        $this->template->render();
        
    }
    
    public function results() {
        
        $search = $this->_accidents->search();
        
        if (count($search) == 0) {            
            $content = "No results found";            
        } else {
            $content = generate_accident_listing($search, array("show_report#" => true));
        }

        $this->template->write("title", "Search Results");
        $this->template->write("heading", "Search Results");
        $this->template->write("content", $content);
        $this->template->render();
        
    }
    
    public function revisions($id) {
        
        $revisions = $this->_accidents->revisions($id);
        
        if (count($revisions) == 0) {            
            $content = "No results found";            
        } else {
            $content = generate_accident_listing($revisions, array("show_revisions" => false));
        }
        
        $title = sprintf('<span class="label label-default">#%s</span> Accident Report Revisions (%d Total)',
                format_accident_report_number($revisions[0]->revision_of),
                count($revisions)
                );

        $this->template->write("title", 'Accident Report Revisions');
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