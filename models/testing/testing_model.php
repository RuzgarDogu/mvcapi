<?php
/**
 * 
 */
class Testing_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function deneme($id)
	{
		return $this->localdb->select("SELECT * FROM data WHERE dataid > {$id} AND app_id IN ({$this->app_yetki})");
	}

	public function uygulamaGetir($app_id)
	{
		return $this->localdb->select("SELECT app_adi, app_id, INET_NTOA(app_ip), app_kisaad, app_sahibi, app_yetki FROM uygulamalar WHERE app_id = '{$app_id}'");
	}

	public function test($userid)
	{
		return $this->localdb->select("SELECT * FROM note WHERE userid = {$userid}");
	}

}
