<?php

class Testing extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	public function test()
	{
		// echo json_encode($this->model->test($this->userid));
		echo json_encode(URL.'controllers/testing/html/index.html');
	}

	public function jwtolustur()
	{
		echo $this->jwt->olustur($this->model->uygulamaGetir(1));
	}


}