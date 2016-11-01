<?php
include 'dbhelper.php';
class DBAdapter{
	private $pdo;
	public static function makePDO(){
		$info = Array("mysql:host=localhost;dbname=art","srich020","srich020");//this may have to be changed depending on your info
		$pdo = DBHelper::createConnection($info);
		return $pdo;
	}
}
?>