<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index() {

        $this->template->write("title", "Dashboard");
        $this->template->write_view("content", "dashboard/index");
        $this->template->render();
        
    }
    
    public function switch_theme() {
        
        $this->auth->required();
        
        $user_id = $this->auth->get_user_id();
        
        $current_theme = $this->_auth->get_user_theme($user_id);
        
        if ($current_theme == NULL) return;
        
        switch ($current_theme) {
            default:
            case 0:
                $new_theme = 1;
                break;
            case 1:
                $new_theme = 0;
                break;
        }
        
        if ($this->_auth->set_user_theme($user_id, $new_theme)) {
            $this->flash->success("Theme switched");
        } else {
            $this->flash->danger("Error switching theme");
        }
        
        redirect();
        
    }

}