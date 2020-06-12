<?php
 
class cDb {
	
	private $_dbname;
    private $_username;
	private $_password;
	private $_db;
	
	public function __construct(){
		$this->_dbname = 'xxx'; 
		$this->_username = 'xxx';
		$this->_password = 'xxx';
		$this->_host = 'localhost';
		$this->getPDO();
	}
	
	public function GetDbHang() {
			return $this->_db;
	}
	
	private function getPDO()
	{
		$opt = array(
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);
		$this->_db = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbname.';charset=utf8', $this->_username, $this->_password, $opt);	
	}
	
	public function GetSelect($query,$params=array())
	{
		$db = $this->_db;
		$stmt = $db->prepare($query);
		$stmt->execute($params);
		$rows = $stmt->fetchAll();
		//? $db = null;
		return $rows;
	}
	
	public function GetExecute($query,$params=array())
	{
		$db = $this->_db;
		$stmt = $db->prepare($query);
		$stmt->execute($params);
		$rows = $stmt->rowCount();
		//? $db = null;
		return $rows;
	}
}
?>
