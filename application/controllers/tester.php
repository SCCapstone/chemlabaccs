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
        
          
        
        // Test Result Output
        echo $this->unit->report();
    }
}?>