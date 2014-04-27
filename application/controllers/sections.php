<?php

/*
 * Class for creating and managing new sections 
 * 
 * Author:
 * Edited by: David Allen
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sections extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->auth->required();

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }
    
    
    //function for creating new section, validates the below fields
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
            
            
            $this->load->model('_section');
            
            
            // Checks that name is unique
            if ($this->_section->nameIsUnique($newSec->name) == false) {
                $this->flash->danger("You already have a section with this name. Please enter a unique name.");
                redirect('sections/createSection');
            }
            
            
            
            //if a new section is created, a section id is created and email
            //sent to creater with section details
            if($this->_section->createSection($newSec)) {
                
                $userSection = new stdClass;
             
                $userSection->section_id = $newSec->id;
                $userSection->user_id = CI()->auth->get_user_id();
                $userSection->pass = $newSec->password;

                $this->load->model('_section');

                $this->_section->join_section($userSection);
                
                $this->load->library('email');
                $this->email->from('accidentreport@chemlabaccs.com', 'LARS Notification');
                $this->email->to(get_email());  
                $this->email->subject('LARS - Your Section Information');  
                $this->email->message("Thank you for creating a section in LARS, below is the Section information to give your students."
                    . "<br>" . "Section ID #:  " . $newSec->id
                    . "<br>" . "Section Password:  " . $newSec->password);
                    
                     
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
    
    //stores the details of the section
    public function detail($id) {
        
        $id = (int) $id;
        
        $data = array();
        
        $sectionInfo = $this->_section->detail($id);
        
        $data["sectionInfo"] = $sectionInfo;
        
        $title = 'Section Details:  ' . $sectionInfo->name;

        $this->template->write("title", 'Section Details');
        $this->template->write("heading", $title);
        $this->template->write_view("content", "section/details", $data);

        $this->template->render();
        
    }
    
    public function edit($id) {
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
         $this->form_validation->set_rules('sectionName', 'Name', 'required');
         $this->form_validation->set_rules('sectionPassword', 'Password', 'required');
         $this->form_validation->set_rules('secTerm', 'Term', 'required');
         $this->form_validation->set_rules('secYear', 'Year', 'required');
         $this->form_validation->set_rules('building', 'Building Name', 'required');
         $this->form_validation->set_rules('room', 'Room #', 'required');
         
        
        $id = (int) $id;

        $sectionInfo = $this->_section->detail($id);
        
        
        
        if ($this->form_validation->run() == FALSE) {
        
            $title = 'Editing Section:  '  .  $sectionInfo->id . ' - "' . $sectionInfo->name . '"';
            $this->template->write("title", $title);
            $this->template->write("heading", $title);
            $this->template->write_view("content", "section/edit", $sectionInfo);
            $this->template->render();
            
        }
        
        else {
            
            $newSec = new stdClass();
            
            $newSec->id = $id;
            $newSec->name = $this->input->post("sectionName");
            $newSec->password = $this->input->post("sectionPassword");
            $newSec->term = $this->input->post("secTerm");
            $newSec->Year = $this->input->post("secYear");
            $newSec->building_name = $this->input->post("building");
            $newSec->room_num = $this->input->post("room");
            $newSec->admin_id = get_userID();
            $newSec->institution_id = 1;    // for now
            
            
            //if section is edited, email
            //sent to creator with section details
            if($this->_section->updateSection($newSec)) {
                
                $userSection = new stdClass;
             
                $userSection->section_id = $newSec->id;
                $userSection->user_id = CI()->auth->get_user_id();
                
                $this->load->library('email');
                $this->email->from('accidentreport@chemlabaccs.com', 'LARS Notification');
                $this->email->to(get_email());  
                $this->email->subject('LARS - Your Section Information Has Changed');  
                $this->email->message("You have edited your section on LARS, below is the NEW Section information to give your students."
                    . "<br>" . "Section ID #:  " . $newSec->id
                    . "<br>" . "Section Password:  " . $newSec->password);
                    
                     
                $this->email->send();
                
                $this->flash->success("You have successfully edited a section!");
                redirect('dashboard/home');
                
            }
            
            else {
                
                $this->flash->danger("Problem editing section. Please try again.");
                redirect('sections/edit/' . $id);
                
            }
  
            
        }
        
        
        
    }
    
    
    public function delete($id) {
        
        $secDetails = $this->_section->detail($id);
        
        if ($this->_section->remove($id)) {
            $this->flash->success("You have successfully DELETED Section: <b>" . $secDetails->name . "</b>");
            redirect('dashboard/home');      
        }
        else {
            $this->flash->danger("Problem deleting Section.");
            redirect('dashboard/home');
        }
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
    
?>