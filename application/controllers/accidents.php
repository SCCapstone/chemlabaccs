<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accidents extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->auth->required();

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function date_check($date) {

        if (valid_date($date) == false) {
            $this->form_validation->set_message("date_check", "%s is not valid");
            return false;
        }

        return true;
    }

    public function time_check($time) {

        if (valid_time($time) == false) {
            $this->form_validation->set_message("time_check", "%s is not valid");
            return false;
        }

        return true;
    }
    
    
    
    
    
   public function comment()
    {
        echo "working"." "."Accident Id: ".$_POST['accidentid'];
        
        // 
        // $this->load->library(commenthandler);
    }
    
    
    
    
    public function add($action = "") {

        /*         * *********************************************************************************** */
        // Accident id's need to have random strings so we can relate our accident id's to our photo id's 
        $this->load->helper('string');
        $accident_id = random_string('numeric', 7);

        /*         * *********************************************************************************** */


        $data = array();
        $data["error"] = NULL;

        $this->form_validation->set_rules('date', 'Date', 'required|callback_date_check');
        $this->form_validation->set_rules('time', 'Time', 'required|callback_time_check');
        $this->form_validation->set_rules('building', 'Building', 'required');
        $this->form_validation->set_rules('room', 'Room', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('severity', 'Severity', 'required');
        $this->form_validation->set_rules('root', 'Root', 'required');
        $this->form_validation->set_rules('prevention', 'Prevention', 'required');

        if ($this->form_validation->run() && $action == "save") {

            $new = new stdClass;

            if ($this->input->post("revision_of")) {
                $new->revision_of = (int) $this->input->post("revision_of");
                $new->user = (int) $this->input->post("user");
                $new->modified_by = $this->auth->get_user_id();
            } else {
                $new->revision_of = 0;
                $new->user = $this->auth->get_user_id();
            }
            $new->date = date_human2mysql($this->input->post("date"));
            $new->time = time_human2mysql($this->input->post("time"));
            $new->building = $this->input->post("building");
            $new->room = $this->input->post("room");
            $new->description = $this->input->post("description");
            $new->severity = $this->input->post("severity");
            $new->root = $this->input->post("root");
            $new->prevention = $this->input->post("prevention");
            $new->id = $accident_id;
            $new->revision_of=$accident_id;

            /*************************************************************************************/
            /*************************************************************************************/
            // Modified by D.Cooper on 2/12/2014
            // Dependencies for the PhotoHandler
            // Used the CI string class to generate a user id so we can pass it to photohandler
            // So each photos is related to a a accident report
            $userid = $this->auth->get_user_id();
            $params = array('userid'=>$userid,'accidentid'=>$accident_id);
            //$params = array($userid, $accident_id);
            $this->input->post("filefield");
            $this->input->post("dynamic_comment");
           /*************************************************************************************/
            if ($this->_accidents->add($new,$accident_id)) {
              // Move the photos and photo descriptions to the database.
             // Optional descriptions are sent by $this->input->post("dynamic_comment");
               $this->load->library('photohandler', $params);
               
           
            /*************************************************************************************/
             
            //Modified by Davis
            //Adding Email to Admin functionality
            //Need to make new gmail account per site name
            //Need to verify if SSL is enabled in the php.ini file ( /xampp/php/php.ini)

                $this->load->library('email');       
                $this->email->from('<NEW GMAIL ACCOUNT>@gmail.com', '<User who created Report>');
            //  $list = array('xxx@gmail.com'); <To include multiple receipients>
            //  $this->email->to($list);
                $this->email->to('alexan84@email.sc.edu');  
                $this->email->subject('Lab Accident Notification');  
                $this->email->message('It is working!');
                $this->email->send();
                echo $this->email->print_debugger();
            // End of modifiction by Davis
                
                $this->flash->success("Report successfully added.");
                redirect("dashboard/home");
            } else {
                $data["error"] = "Error adding report. Please Try again.";
            }
        }

        $title = "Add Accident Report";

        $this->template->write("title", $title);
        $this->template->write("heading", $title);
        $this->template->write_view("content", "accidents/add", $data);

        $this->template->render();
    }

    public function detail($id) {

        $id = (int) $id;

        $data = array();

        $details = $this->_accidents->detail($id);

        if ($details != NULL) {
            $data["details"] = $details;
        } else {
            redirect("dashboard");
        }

        $title = sprintf('<span class="label label-default">#%s</span> Accident Report Details', format_accident_report_number($details->revision_of));

        $this->template->write("title", 'Accident Report Details');
        $this->template->write("heading", $title);
        $this->template->write_view("content", "accidents/detail", $data);

        $this->template->render();
    }

    public function results() {

        $search = $this->_accidents->search();

        if (count($search) == 0) {
            $content = "No results found";
        } else {
            $content = generate_accident_listing($search, array("show_report#" => true));
        }

        $this->template->write("title", "Search Results");
        $this->template->write("heading", "Search Results");
        $this->template->write("content", $content);
        $this->template->render();
    }

    public function revisions($id) {

        $revisions = $this->_accidents->revisions($id);

        if (count($revisions) == 0) {
            $content = "No results found";
        } else {
            $content = generate_accident_listing($revisions, array("show_revisions" => false));
        }

        $title = sprintf('<span class="label label-default">#%s</span> Accident Report Revisions (%d Total)', format_accident_report_number($revisions[0]->revision_of), count($revisions)
        );

        $this->template->write("title", 'Accident Report Revisions');
        $this->template->write("heading", $title);
        $this->template->write("content", $content);
        $this->template->render();
    }

    public function search($action = "") {

        $data = array();

        $this->template->write("title", "Search Accident Reports");
        $this->template->write("heading", "Search Accident Reports");
        $this->template->write_view("content", "accidents/search", $data);

        $this->template->render();
    }

}