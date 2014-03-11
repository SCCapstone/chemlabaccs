<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tester extends CI_Controller {

    public function index()
    {
        //Test 1
        $this->load->library('unit_test');
        $test = 1 + 1;
        $expected_result = 2;
        $test_name = 'Adds one plus one';
        $this->unit->run($test, $expected_result, $test_name);   

        //Test 2
        $a=array();
        $this->unit->run(sizeof($a), 0, 'Empty array'); 
        
        // Test Result Output
        echo $this->unit->report();
    }
}?>