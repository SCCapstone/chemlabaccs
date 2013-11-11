<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accident extends CI_Controller {
    
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
            redirect("accident/all");
        }

        $this->template->write("title", "Detailed Accident Report");
        $this->template->write("heading", "Detailed Accident Report");
        $this->template->write_view("content", "accidents/detail", $data);
        
        $this->template->render();
        
    }
    
    public function query() {
        
        $this->db->select("accidents.id, date, time, buildings.name, room,
            description, severity, root, prevention, users.email, created");
        $this->db->from("accidents");
        $this->db->join("buildings", "accidents.building = buildings.id");
        $this->db->join("users", "accidents.user = users.id");
        
        
        /*
         * SELECT a.*
FROM accidents a
LEFT JOIN accidents b ON (a.revision_of = b.revision_of AND a.id < b.id) WHERE b.id IS NULL
         */
        
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
        
        return $this->db->get();
        
    }
    
    public function results() {
        
        $query = $this->query();
        
        if ($query->num_rows() == 0) {            
            $content = "No results found";            
        }
        
        $this->table->set_heading(
            "Date/Time",
            "Building",
            "Room",
            "Severity",
            "Enter User",
            "Created On",
            "Actions"
        );
        
        foreach ($query->result() as $acc) {
                
            $actions = array(
                anchor("accident/detail/" . $acc->id, '<span class="glyphicon glyphicon-eye-open"></span> Details', array(
                    "class" => "btn btn-default"
                )),
                anchor("accident/revisions/" . $acc->id, '<span class="glyphicon glyphicon-list-alt"></span> Revisions', array(
                    "class" => "btn btn-default"
                ))
            );
            
            $user = String($acc->email);

            $this->table->add_row(array(
                date_mysql2human($acc->date) . " " . time_mysql2human($acc->time),
                $acc->name,
                $acc->room,
                $acc->severity,
                $user->substring(0, $user->indexOf("@")),
                date("m/d/Y g:i a", strtotime($acc->created)),
                implode(' ', $actions)
            ));

        }
        
        $content = $this->table->generate();

        $this->template->write("title", "Search Results");
        $this->template->write("heading", "Search Results");
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