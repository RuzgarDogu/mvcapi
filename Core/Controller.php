<?php
/**
 * 
 */
class Controller
{
	// Bu alttaki değişkeni alttaki modelYukle fonksiyonuna gönderdik ki, veritabanından veri çekerken kullanalım.
	public $uygulama_yetkisi;
	public $userid;

	function __construct(){
		// Access-Control-Allow-Origin HTACCESS tarafında tanımlanıyor. 
		header('Access-Control-Allow-Headers: X-Requested-With');
		header('x-requested-with: XMLHttpRequest');
		
		
		if($_SERVER['REQUEST_METHOD'] == "GET") {

			header('Content-Type: text/plain');
			echo "Hatalı İstek-1";
			die;
			
		} elseif($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
			// Tell the Client we support invocations from arunranga.com and 
			// that this preflight holds good for only 20 days
			
			if($_SERVER['REMOTE_ADDR'] == IZINLIIP) {
				header('Access-Control-Allow-Origin: http://arunranga.com');
				header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
				header('Access-Control-Allow-Headers: X-PINGARUNER');
				header('Access-Control-Max-Age: 1728000');
				header("Content-Length: 0");
				header("Content-Type: text/plain");
			  //exit(0);
			} else {
				header("HTTP/1.1 403 Access Forbidden");
				header("Content-Type: text/plain");
				echo "Hatalı İstek-2";
			}
			
		} elseif($_SERVER['REQUEST_METHOD'] == "POST") {
			// Handle POST by first getting the XML POST blob, 
			// and then doing something to it, and then sending results to the client
			
			if($_SERVER['REMOTE_ADDR'] == IZINLIIP) {
			//   $postData = file_get_contents('php://input');
			//   $document = simplexml_load_string($postData);
				
			  // do something with POST data
				$contenttype = CONTENTTYPE;
				header("Content-Type: $contenttype");
				header('Access-Control-Allow-Origin: *');
			} else {
				die("Hatalı İstek-3");
			}
		} else {
			die("Hatalı İstek-4");
		}
		
		$this->jwt = new Jwt();
		$w = $this->getir('w');
		$this->uygulama_yetkisi = $this->jwt->dogrula($w);

		if ($this->uygulama_yetkisi == false) {
			echo "You Shall Not Pass";
			die;
		} else {
			$payload = $this->jwt->payloadCozumle($w);
			if (isset($payload->userid)) {
				$this->userid = $payload->userid;
			}
			
		}
	}

	public function modelYukle($model, $yol)
	{
		$yol .= $model.'/'.$model.'_model.php';
		if (file_exists($yol)) {
			require $yol;
			
			$modelClassAdi = ucfirst($model).'_Model';
			$this->model = new $modelClassAdi();
			$this->model->uygulama_yetkisi = $this->uygulama_yetkisi;
		}    		
	}

	public function getir($v, $d=null)
	{
		if(isset($_POST[$v])) {
			$r = $_POST[$v];
		} else {
			$r = $d;
		}
		return $r;
	}

}
