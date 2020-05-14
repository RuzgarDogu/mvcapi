<?php

class Veritabani extends PDO
{
	
	public function __construct($VT_TIPI, $VT_SUNUCUSU, $VT_ADI, $VT_USER, $VT_PASS, $VT_PORT)
	{
		if ($VT_TIPI == 'mysql') {
			parent::__construct($VT_TIPI.':host='.$VT_SUNUCUSU.';port='.$VT_PORT.';dbname='.$VT_ADI, $VT_USER, $VT_PASS);
		} elseif ($VT_TIPI == 'sqlsrv') {
			parent::__construct($VT_TIPI . ':server=' . $VT_SUNUCUSU . ',' . $VT_PORT . ' ;Database=' . $VT_ADI, $VT_USER, $VT_PASS);
		}
		// parent::setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
		//parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTIONS);
	}
	
	/**
	 * select
	 * @param string $sql An SQL string
	 * @param array $array Paramters to bind
	 * @param constant $fetchMode A PDO Fetch mode
	 * @return mixed
	 */
	public function select($sql, $fetchMode = PDO::FETCH_ASSOC)
	{
		$sth = $this->prepare($sql);
		$sth->execute();
		return $sth->fetchAll($fetchMode);
	}
	
	/**
	 * insert
	 * @param string $table A name of table to insert into
	 * @param string $data An associative array
	 */
	public function insert($sql)
	{
		$sth = $this->prepare($sql);
		$sth->execute();
	}
	
	/**
	 * update
	 * @param string $table A name of table to insert into
	 * @param string $data An associative array
	 * @param string $where the WHERE query part
	 */
	public function update($sql)
	{
		
		$sth = $this->prepare($sql);
		$sth->execute();
	}
	
	/**
	 * delete
	 * 
	 * @param string $table
	 * @param string $where
	 * @param integer $limit
	 * @return integer Affected Rows
	 */
	public function delete($sql)
	{
		$sth = $this->prepare($sql);
		$sth->execute();
	}
	
}