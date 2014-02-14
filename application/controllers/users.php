<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

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
    
    
     public function register($action = "") {
         
        $data = array();
        $data["error"] = NULL;
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
    
        
         if ($this->form_validation->run() && $action == "save") {
            
            $new = new stdClass;
            
            $new->email = $this->input->post("email");
            $new->password = $this->input->post("password");
            $new->passwordconf = $this->input->post("passwordconf");
            $new->userlvl = 0;          // these will be hard coded...
            $new->institutionid = 0;    // ...for now...
            
            
            if ($this->_users->register($new)) {
                $this->flash->success("New Account successfully created.");
                redirect("dashboard/home");
            } else {
                $data["error"] = "Error with registration. Please Try again.";
            }
             
         }
         
        $title = "Register as new user";

        $this->template->write("title", $title);
        $this->template->write("heading", $title);
        $this->template->write_view("content", "view_register", $data);
        
        $this->template->render();
        
        
        
        
     }

}