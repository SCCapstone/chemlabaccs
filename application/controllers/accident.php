<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accident extends CI_Controller {
    
    public function __construct() {
        
        parent::__construct();
        
        $this->auth->required();
        
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('building', 'Building', 'required');
        $this->form_validation->set_rules('room', 'Room', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('severity', 'Severity', 'required');
        $this->form_validation->set_rules('root', 'Root', 'required');
        $this->form_validation->set_rules('prevention', 'Prevention', 'required');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
    }
    
    public function index() {
        
        
        
    }

    public function add($action = "") {
        
        $data = array();
        $data["error"] = NULL;

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
                redirect("accident/add");
            } else {
                $data["error"] = "Error adding report. Please Try again.";
            }
            
        }

        $this->template->set_master_template("template-main");
        $this->template->write("title", "Add Accident Report");
        $this->template->write_view("content", "accidents/add", $data);
        
        $this->template->render();
            
    }
    
    public function all() {
        
        $data = array();
        
        $accidents = $this->_accidents->all();
        
        $this->table->set_template(array (
            "table_open" => '<table class="table table-striped">'
        ));
        
        $this->table->set_heading(
            "Date",
            "Time",
            "Building",
            "Room",
            "Severity",
            "Enter User",
            "Actions"
        );
        
        if ($accidents != NULL) {
            
            foreach ($accidents as $acc) {
                
                $this->table->add_row(array(
                    date_mysql2human($acc->date),
                    time_mysql2human($acc->time),
                    $acc->building,
                    $acc->room,
                    $acc->severity,
                    $this->_auth->get_user_name($acc->user),
                    anchor("accident/detail/" . $acc->id, "Details")
                ));
                
            }
            
            $data["content"] = $this->table->generate();
            
        } else {
            $data["content"] = "There are no accidents.";
        }

        $this->template->set_master_template("template-main");
        $this->template->write("title", "View Accident Reports");
        $this->template->write_view("content", "accidents/all", $data);
        
        $this->template->render();
        
    }
    
    public function detail($id) {
        
        $data = array();
        $data["details"] = $this->_accidents->detail($id);

        $this->template->set_master_template("template-main");
        $this->template->write("title", "View Detailed Accident Report");
        $this->template->write_view("content", "accidents/detail", $data);
        
        $this->template->render();
        
    }

}