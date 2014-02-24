<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sections extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->auth->required();

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }
    
    
    
    public function createSection() {
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $view_data = array();
        $view_data["error"] = NULL;
        
        
         $this->form_validation->set_rules('sectionName', 'Name', 'required');
         $this->form_validation->set_rules('sectionPassword', 'Password', 'required');
         $this->form_validation->set_rules('term', 'Term', 'required');
         $this->form_validation->set_rules('year', 'Year', 'required');
         $this->form_validation->set_rules('building', 'Building Name', 'required');
         $this->form_validation->set_rules('room', 'Room #', 'required');
        
        if ($this->form_validation->run() == FALSE) {
        
            $title = "Create a Section";
            $this->template->write("title", $title);
            $this->template->write("heading", $title);
            $this->template->write_view("content", "register/createSection", $view_data);
            $this->template->render();
            
        }
        
        else {
            
            $newSec = new stdClass();
            
            $this->load->helper('string');
            
            $newSec->id = random_string('numeric', 7);
            $newSec->name = $this->input->post("sectionName");
            $newSec->password = $this->input->post("sectionPassword");
            $newSec->term = $this->input->post("term");
            $newSec->year = $this->input->post("year");
            $newSec->building_name = $this->input->post("building");
            $newSec->room_num = $this->input->post("room");
            $newSec->admin_id = get_userID();
            $newSec->institution_id = 1;    // for now
            
            
            $this->load->model(_section);
            
            if($this->_section->createSection($newSec)) {
                
                $userSection = new stdClass;
             
                $userSection->section_id = $newSec->id;
                $userSection->user_id = CI()->auth->get_user_id();

                $this->load->model('_section');

                $this->_section->join_section($userSection);
                
                $this->load->library('email');
                $this->email->from('accidentreport@chemlabaccs.com', 'LARS Notification');
                $this->email->to(get_email());  
                $this->email->subject('LARS - Your Section Information');  
                $this->email->message("Thank you for creating a section in LARS, below is the Section information to give your students."
                    . "\n" . "Section ID #:  " . $newSec->id
                    . "\n" . "Section Password:  " . $newSec->password);
                    
                     
                $this->email->send();
                
                $this->flash->success("You have successfully created a section!");
                redirect('dashboard/home');
                
            }
            
            else {
                
                $this->flash->danger("Problem creating section. Please try again.");
                redirect('sections/createSection');
                
            }
  
            
        }
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
    
?>