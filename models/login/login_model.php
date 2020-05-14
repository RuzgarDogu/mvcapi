<?php
/**
 * 
 */
class Login_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	// public function deneme($id)
	// {
	// 	return $this->localdb->select("SELECT * FROM data WHERE dataid > {$id} AND app_id IN ({$this->app_yetki})");
	// }ss

	public function uygulamaGetir($app_id)
	{
		$app =  $this->localdb->select("SELECT app_adi, app_id, INET_NTOA(app_ip) as app_ip, app_kisaad, app_sahibi, app_yetki FROM uygulamalar WHERE app_id = '{$app_id}'");
		return $app[0];
	}

	public function app_is_active($app_id)
	{
		$app_yetki = $this->localdb->select("SELECT app_yetki FROM uygulamalar WHERE app_id = '{$app_id}'");

		if (count($app_yetki) && $app_yetki[0]['app_yetki'] > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function userCheck($u, $p)
	{
		$pass = Hash::create('sha256', $p, HASH_PASSWORD_KEY);
		$query = "SELECT us.userid, us.role, us.user_name, us.app_id, INET_NTOA(uy.app_ip) as app_ip FROM user us LEFT JOIN uygulamalar uy ON uy.app_id = us.app_id WHERE us.login = '{$u}' AND us.password = '{$pass}'";
		$check = $this->localdb->select($query);
		return $check;

	}

}
