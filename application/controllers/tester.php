<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tester extends CI_Controller {

    public function index()
    {
        //Test 1
        $this->load->library('unit_test');
        $test = 1 + 1;
        $expected_result = 2;
        $test_name = 'Adds one plus one -- test codeigniter unit_test library';
        $this->unit->run($test, $expected_result, $test_name);   

        //Test 2
        $a=array();
        $this->unit->run(sizeof($a), 0, 'Empty array -- test codeigniter unit_test library'); 
        
        //chemlabaccs_helper testing
        
        $test = date_human2mysql('3-12-2014');
        $this->unit->run($test, 'is_string', 'Test if the return value of date_human2mysql is string.');
        
        $test = time_human2mysql('11:20 AM');
        $this->unit->run($test, 'is_string', 'Test if the return value of time_human2mysql is string.');
        
        $test = date_mysql2human('2014-02-28');
        $this->unit->run($test, 'is_string', 'Test if the return value of date_mysql2human is string.');
        
        $test = time_mysql2human('23:30:04');
        $this->unit->run($test, 'is_string', 'Test if the return value of time_mysql2human is string.');
        
        $test = get_admin('7211618');  // values from local DB, not live site
        $this->unit->run($test, '36', 'Test function get_admin --> expected to return admin_id = 36 for section_id = 7211618.','values from local mySQL DB, not live site.');
        
        $test = get_email();
        $this->unit->run($test, 'alexan84@email.sc.edu', 'Test function get_email() --> expected to return my email address = alexan84@email.sc.edu','values from local mySQL DB, not live site.');
        
        $test = get_email_id('37');
        $this->unit->run($test, 'dangerdave10@gmail.com', 'Test function get_email_id() --> expected to return my email address given user_id as argument = dangerdave10@gmail.com','values from local mySQL DB, not live site.');
        
        $test = get_userID();
        $this->unit->run($test, '36', 'Test function get_userID() --> expected to return my user_id = 36','values from local mySQL DB, not live site.');
        
        $test = get_sections();
        $this->unit->run($test, 'is_array', 'Test function get_sections() --> expected to return an array of section NAMES that user is part of','Checks if returned value is an array');
        
        $test = get_sections_ids();
        $this->unit->run($test, 'is_array', 'Test function get_sections_ids() --> expected to return an array of section IDS that user is part of','Checks if returned value is an array');
        
        $test = get_all_section_ids();
        $this->unit->run($test, 'is_array', 'Test function get_all_section_ids() --> expected to return an array of ids of ALL sections','Checks if returned value is an array');
        
        $test = get_sections_pass();
        $this->unit->run($test, 'is_array', 'Test function get_sections_pass() --> expected to return an array of section PASSWORDS that user is part of','Checks if returned value is an array');
        
        $test = get_terms();
        $this->unit->run($test, 'is_array', 'Test function get_terms() --> expected to return an array of terms like Spring, Fall etc.','Checks if returned value is an array');
        
        $test = get_years();
        $this->unit->run($test, 'is_array', 'Test function get_years() --> expected to return an array of years','Checks if returned value is an array');
        
        $test = format_accident_report_number('24');
        $this->unit->run($test, '0024', 'Test function format_accident_report_number() --> input (24) output (0024)','Checks if expected result is correct');
        
        // Test Result Output
        echo $this->unit->report();
    }
}?>