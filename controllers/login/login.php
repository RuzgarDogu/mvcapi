<?php

class Login extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function test()
	{
		
		$id = $this->getir("w", 0);
		echo json_encode($this->model->uygulamaGetir(1));
		die;
		// if ($this->uygulama_yetkisi) {
		// 	echo json_encode($this->model->deneme($id));
		// } else {
		// 	echo json_encode("Geçersiz Ürün Anahtarı..");
		// }
	}

	public function jwtolustur($pl)
	{
		return $this->jwt->olustur($pl);
	}

	public function purchasejwtolustur()
	{
		// Purchase key için veritabanından yapıyoruz.
		echo $this->jwt->olustur($this->model->uygulamaGetir(1));
	}


	public function passlogin()
	{
		$w = $this->getir('w');
		echo json_encode("app/panel/panel.html");
	}


	public function run()
	{
		$u = $this->getir('u');
		$p = $this->getir('p');
		$w = $this->getir('w');
		$r = $this->getir('r');

		$app = $this->jwt->payloadCozumle($w);
		$app_is_active = $this->model->app_is_active($app->app_id);

		if ($app_is_active) {
			$response = $this->model->userCheck($u,$p);
		} else {
			$response = "Uygulamanızın lisansına ait kullanım süreniz dolmuş, ya da lisansınız iptal edilmiştir.";
		}


		if (count($response)) {
			$j = $this->jwtolustur($response[0]);
			$object = new stdClass();
				$object->j = $j;
				$object->remember = $r;
				$object->gorev = $response[0]['role'];
				$object->isim = $response[0]['user_name'];
			echo json_encode($object);
		} else {
			echo "Böyle bir kullanıcı yok";
		}
	}

	public function logout()
	{
		$w =  $this->getir('w');
		$pl = $this->jwt->payloadCozumle($w);
		$object = new stdClass();
		$object->j = $w;
		$object->remember = false;
		$object->gorev = $pl->role;
		$object->isim = $pl->user_name;
			echo json_encode($object);
	}


}