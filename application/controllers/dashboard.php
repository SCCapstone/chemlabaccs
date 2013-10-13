<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index() {

        $this->template->write('title', 'Dashboard');
        $this->template->write('content', 'asdf');
        $this->template->render();
        
    }

}