<?php
/**
 * 
 */
class Model {

	function __construct() {
		$this->localdb = new Veritabani(LOCAL_DB_TYPE, LOCAL_DB_HOST, LOCAL_DB_NAME, LOCAL_DB_USER, LOCAL_DB_PASS, LOCAL_DB_PORT);
		
		// ****************************
		// EĞER SQL server devreye girecekse, alttaki satırı da eklememiz lazım.
		// ****************************

		// $this->sqldb = new Veritabani(SQL_DB_TYPE, SQL_DB_HOST, SQL_DB_NAME, SQL_DB_USER, SQL_DB_PASS, SQL_DB_PORT);
	}

}