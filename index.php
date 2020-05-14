<?php
// echo "api_index</br>";
// Configürasyon dosyasını çağırıyoruz.
require 'config.php';
// Yönetici Class'ları yüklüyoruz.////////
	// Rota
	// Login
	// Hash
	// Auth
	// Session
	// Veritabanı
	// Controller
	// Model
	// Kutuphane
	// Hata
//////////////////////////////////////////
function yoneticiClasslariYukle($class) {
    require_once(CORE . $class .".php");
}
spl_autoload_register('yoneticiClasslariYukle');

$rota = new Rota;
$rota->baslat();