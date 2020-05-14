<?php

class Userlink extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	public function getUserLinks()
	{
		$userlinks = $this->model->getUserLinks($this->userid);
		echo json_encode($userlinks);
	}


}