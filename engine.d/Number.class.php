<?php
class Number{
	static function list($q){
	$query = "SELECT * FROM cloto_number where `value` like  '%$q%'";
		$resuts = dbQuery($query);
		$resposta = [];
		foreach($resuts as $i){
			$nD = Dado::getI($i["id"]);
			//var_dump($nD);
			if($nD){
				$nD["value"] = $i["value"];
				$nD["type"] = $nD["tipo"];
				$resposta[] = $nD;
				
			}
		}
    return $resposta;
	}
    static function get($id){
    	$query = "SELECT * FROM cloto_number where id = $id;";
      $resuts = dbQuery($query);
      $valor = $resuts[0]["value"];
      return $valor;
    }
    static function add($id,$value){
			$query = "insert into `cloto_number` set 
				id='$id',
				value='$value'";
    	$id = dbQueryId($query);
    	
    	return $id;
    }
    static function update($id, $value){
    	$query = "update `cloto_number` 
    		set `value`='$value' 
    		where `id`='$id'
    	limit 1";
    	$id = dbQueryId($query);
    	return $id;
    }
}
