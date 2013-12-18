<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Charts extends CI_Controller {

	function Charts()
	{
		parent::__construct();

		$this->view_data = array();
	}
	
	public function index()
	{
		$buildings = get_buildings(true);
		$reports = get_latest_reports($this->db);
		$building_count = find_building_count($reports, $buildings);
	    
		for($i = 1; $i < count($buildings); $i++)
		{
			$data = array($building_count[$i],$building_count[$i],$building_count[$i]);
			$series_data[] = array('name' => $buildings[$i], 'data' => $data);
		}
		
		$title = "Anonymous Data";
		$this->view_data['series_data'] = json_encode($series_data);
		
        $this->template->write("title", $title);
		$this->template->write_view("content", "view_charts", $this->view_data);
		$this->template->render();
	}
}
