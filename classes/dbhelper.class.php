<?php 
//direct data access 
//to call this class ensure static syntax is being used (DBHelper:CreateConnection($Array(DBHOST, DBUSER, DBPASS))
class DBHelper{
	//this function is only here until we decide where to put the actual call to the pdo
public static function createConnection($value=Array()){
	try{
	$pdo = new PDO(value[0],value[1],value[2]);//connection needs array with the connection values in it (HOST, USER, PASSWORD)
	$pdo->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	return $pdo;
	}catch(PDOException $ex){
		die($ex->getMessage());
	}
}
public static function runQuery($pdo,$sql,$parameters=Array()){
	if(!is_array($parameters)){
		$parameters = Array($parameters);
	}
	try{
		$statement = null;
		if(count($parameters) > 0){
			$statement = $pdo->prepare($sql);
			for($i = 0; $i < count($parameters);$i++)
			{
				$statement->bindValue($i+1,$parameters[$i]);
			}
			$statement->execute();
		}else{
			$statement = $pdo->query($sql);
		}
		return $statement;
	}catch(PDOException $ex){
		die($ex->getMessage());	
	}
}	
}?>