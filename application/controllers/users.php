<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {
    
    private $CI = NULL;
    
    public function __construct() {
        
        parent::__construct();
        
       // $this->auth->required();
        
        $this->table->set_template(array (
            "table_open" => '<table class="table table-striped">'
        ));
        
        $this->CI = & get_instance();
        
    }

    public function index() {

        redirect('users/signin');
        
    }
    
    public function authenticate() {
        
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');

        if ($this->auth->authenticate($user_name, $password)) {
            $this->flash->success("You have been signed in");
            redirect('');
        } else {            
            $this->flash->danger("Invalid username/password combination");
            redirect('users/signin'); 
        } 
        
    }

    public function signin() {
        
        $this->template->set_master_template('sign-in');
        $this->template->write('title', 'Please sign in');        
        $this->template->render();
        
    }

    public function signout() {

        $this->auth->deauthenticate();
        
        $this->flash->success("You have been signed out");
        
        redirect();
        
    }
    
    
     public function register() {
         
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
         
        $view_data = array();
        $view_data["error"] = NULL;
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passwordconf', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('level', 'Account Type', 'required');
    
        // has not been run or there are validation errors
         if ($this->form_validation->run() == FALSE) {
            $title = "Register as new user";
            $this->template->write("title", $title);
            $this->template->write("heading", $title);
            $this->template->write_view("content", "register/view_register", $view_data);
            $this->template->render();
              //echo "if";
            // $this->load->view('view_register');
         }
         
         // everything good - process the form
         else {
             
            $newUser = new stdClass;
             
            $newUser->email = $this->input->post("email");
            $newUser->password = $this->input->post("password");
            $newUser->passwordconf = $this->input->post("passwordconf");
            
            if ($this->input->post("level") == 'admin') {
                $newUser->userlvl = 1;  // admin level
            }
            else {
                $newUser->userlvl = 9;  // basic user level
            }
                
           
            
            $auth = new Auth();

            // if new user is created successfully
            if($auth->create_user($newUser)) {
                
                
                $this->load->library('email');
                $this->email->from('NewUserAccount@chemlabaccs.com', 'Welcome to LARS!');
                $this->email->to($newUser->email); 
                $this->email->subject('Lab Accident Notification');  
                $this->email->message("Welcome to LARS (Lab Accident Reporting System) ! <br>Your new account info is listed below,<br><br> " 
                        . "Username/Email:  " . $newUser->email 
                        . "<br>" . "Password:  " . $this->input->post("password"));
                $this->email->send();
                
                
                // if student account was created
                if($newUser->userlvl == 9) {
                    $this->flash->success("New Account successfully created! You may now sign-in and join a Section.");
                    redirect('users/signin');
                    
                    
                    
                }
                
                // if admin account was created
                elseif ($newUser->userlvl == 1) {
                    $this->flash->success("New Admin account successfully created! You may now sign-in and create a Section.");
                    redirect('users/signin');
                }
            }  
            
            else {
                $data["error"] = "Error with registration. Please Try again.";
                redirect('users/register');
            }
             
         }
       
        
       
        
        
     }
    //function to join a specific section 
     public function joinSection() {
       
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
         
        $view_data = array();
        $view_data["error"] = NULL;
         
        
        $this->form_validation->set_rules('sectionID', 'Section ID #', 'required');
        $this->form_validation->set_rules('sectionPassword', 'Section Password', 'required');
        
        
        if ($this->form_validation->run() == FALSE) {
            $title = "Join a Section";
            $this->template->write("title", $title);
            $this->template->write("heading", $title);
            $this->template->write_view("content", "register/joinSection", $view_data);
            $this->template->render();
         }
          else {
             
            $userSection = new stdClass;
             
            $userSection->section_id = $this->input->post("sectionID");
            $userSection->user_id = CI()->auth->get_user_id();
            
            $this->load->model('_section');
            
            if($this->_section->join_section($userSection)) {
                $this->flash->success("You have successfully joined the section!");
                redirect('dashboard/home');
            }
            else {
                $this->flash->danger("Problem joining section. Please try again.");
                redirect('users/joinSection');
            }
            
          }
         
         
         
     }
     
     public function test() {
         
         $this->load->view('test');
     }
     
     

}