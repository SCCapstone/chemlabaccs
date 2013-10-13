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

}