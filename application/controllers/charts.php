<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Charts extends CI_Controller {

	function Charts()
	{
		parent::__construct();

		$this->view_data = array();
	}
	
	public function index()
	{
		$data = get_buildings(true);
		foreach ($data as $columnName => $columnData) 
		{
			//echo 'Column name: ' . $columnName . ' Column data: ' . $columnData . '<br />';
		}
		
		$i = 1;
		//need to get data from database instead of hard coding it
		$series_data[] = array('name' => $data['1'], 'data' => array(8,7,4));
		$series_data[] = array('name' => $data['2'], 'data' => array(5,4,3));
		$series_data[] = array('name' => $data['3'], 'data' => array(1,0,2));
		$series_data[] = array('name' => $data['4'], 'data' => array(9,4,7));
		
		
		$title = "Anonymous Data";
		$this->view_data['series_data'] = json_encode($series_data);
		
        $this->template->write("title", $title);
		$this->template->write_view("content", "view_charts", $this->view_data);
		$this->template->render();
	}
}
