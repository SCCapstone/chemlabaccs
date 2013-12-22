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
	    $time_percents = find_time_percents($reports);
		$severity_percents = find_severity_percents($reports);
		
		for($i = 1; $i < count($buildings); $i++)
		{
			$data = array($building_count[$i],$building_count[$i],$building_count[$i]);
			$series_data[] = array('name' => $buildings[$i], 'data' => $data);
		}
		
		//currently count serves as the names, need to change it to represent each time period
		$count = 1;
		foreach($time_percents as $time)
		{
			if($time > 0)
				$time_data[] = array('name' => $count, 'data' => $time);
			$count++;
		}
		
		$count = 1;
		$star = ' star';
		foreach($severity_percents as $sev)
		{
			if($count > 1)
				$star = ' stars';
			$severity_data[] = array('name' => $count . $star, 'data' => $sev);
			$count++;
		}
		
		$title = "Anonymous Data";
		$this->view_data['series_data'] = json_encode($series_data);
		$this->view_data['severity_data'] = $severity_data;
		$this->view_data['time_data'] = $time_data;
        $this->template->write("title", $title);
		$this->template->write_view("content", "view_charts", $this->view_data);
		$this->template->render();
	}
}
