<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function index() {

        redirect('users/signin');
        
    }

    public function signin() {

        echo $this->auth->authenticate('', '');
        
    }

    public function signout() {

        echo $this->auth->deauthenticate();
        
    }

}