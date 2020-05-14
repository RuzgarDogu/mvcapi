<?php
/**
 * 
 */
class Userlink_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	public function getUserLinks($userid)
	{
		$q = "SELECT lk.id, lk.fa, lk.name, lk.url FROM userlink ul LEFT JOIN links lk ON lk.id = ul.linkid WHERE ul.userid = {$userid}";
		return $this->localdb->select($q);
	}

}
