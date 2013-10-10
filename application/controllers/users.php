<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function index() {

        echo "users";
        
    }
    
    public function a() {
        
        echo $this->auth->authenticate('scribell', '$95st@ng');
        
    }
    
    public function d() {
        
        echo $this->auth->deauthenticate();
        
    }
    
    public function t() {
        
        echo $this->auth->required();
        echo 'secret';
        
    }
    
    public function create() {
        
        $user = new stdClass();
        $user->email = 'scribell@email.sc.edu';
        $user->password = '$95st@ng';
        
        $this->auth->create_user($user);
        
    }

}