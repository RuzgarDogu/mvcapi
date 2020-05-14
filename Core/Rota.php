<?php
class Rota {
	
    private $_url;
    private $_controllerYolu = CONTROLLERYOLU;
    private $_modelYolu = MODELYOLU;
    private $_controller = NULL;

	public function baslat() // initilizasyon
	{
        $this->_getUrl(); // Url'yi yakalayıp array'e at
        $this->_controllerGetir(); // Url'den controller yolunu getir.
		// echo '<pre>' . var_export($this->_url, true) . '</pre>';
        $this->_metoduGetir(); // Eğer metod varsa getir.
	}

    private function _getUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        $this->_url = $url;
    }

    private function _controllerGetir() {
        $dosyaYolu = (count($this->_url) > 0) ? $this->_controllerYolu . $this->_url[0]  . '/'. $this->_url[0] .'.php' : NULL ;

        if (file_exists($dosyaYolu)) {
            require $dosyaYolu;
            // _url[0]'ın içinde bulunan Class instance'ı yaratıyoruz. Ki böylelikle metoduna erişelim.
            $this->_controller = new $this->_url[0];
            $this->_controller->modelYukle($this->_url[0], MODELYOLU);
        } else {
            if ($this->_url[0] == '') {
                return false;
                // Burada bir ana sayfa belirlemek durumundayız. Api olduğu için gerek de yok aslında.
                // echo "Main index";
            } else {
                // require $this->_hata;
                $_hata = new Hata("İstemiş olduğunuz API mevcut görünmüyor.");
            }
        }
    }

    private function _metoduGetir()
    {
        if (count($this->_url) > 1) {
            // echo "metodu getir<br>";
            // Metodu çağırıyoruz.
            if(method_exists($this->_controller, $this->_url[1])) {
                $this->_controller->{$this->_url[1]}();    
            } else {
                $_hata = new Hata("Böyle bir metod yok<br>");
            }
        }
    }
}