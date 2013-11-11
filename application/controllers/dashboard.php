<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index() {
        
        $user = new stdClass;
        $user->email = "cieplows@email.sc.edu";
        $user->password = "123456";
        $this->auth->create_user($user);
        $user = new stdClass;
        $user->email = "carrow@email.sc.edu";
        $user->password = "123456";
        $this->auth->create_user($user);
        $user = new stdClass;
        $user->email = "hamodm@email.sc.edu";
        $user->password = "123456";
        $this->auth->create_user($user);

        $this->template->write('title', 'Dashboard');
        $this->template->write('content', 'asdf');
        $this->template->render();
        
    }

}