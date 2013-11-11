<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accident extends CI_Controller {
    
    public function __construct() {
        
        parent::__construct();
        
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

    public function add($action = "") {

        if ($this->form_validation->run() && $action == "save") {
            
            $new = new stdClass;
            
            $new->date = $this->input->post("date");
            $new->time = $this->input->post("time");
            $new->building = $this->input->post("building");
            $new->room = $this->input->post("room");
            $new->description = $this->input->post("description");
            $new->severity = $this->input->post("severity");
            $new->root = $this->input->post("root");
            $new->prevention = $this->input->post("prevention");
            
            $this->db->insert("accidents", $new);
            
        }

        $this->template->set_master_template("template-main");
        $this->template->write("title", "Add Accident Report");
        $this->template->write_view("content", "accidents/add");
        
        $this->template->render();
            
    }

}