<?php
class Text{
	static function list($q){
	$query = "SELECT * FROM cloto_text where `value` like  '%$q%'";
		$resuts = dbQuery($query);
		$resposta = [];
		foreach($resuts as $i){
			$nD = Dado::getI($i["id"]);
			//var_dump($nD);
			if($nD){
				if(strlen($i["value"])>255) 
					$nD["value"] = substr($i["value"],0,255)."...";
				else $nD["value"] = $i["value"];
				
				$nD["type"] = $nD["tipo"];
				$resposta[] = $nD;
			}
		}
    return $resposta;
	}
    //deve ter um get pra pegar so o comecinho
    static function get($id){
    	$query = "SELECT * FROM cloto_text where id = $id;";
      $resuts = dbQuery($query);
      $valor = $resuts[0]["value"];
      return $valor;
    }
    static function getP($id){
    	$query = "SELECT * FROM cloto_text where id = $id;";
      $resuts = dbQuery($query);
      $valor = $resuts[0]["value"];
      if(strlen($valor)>255) $valor = substr($valor,0,255)."...";
      return $valor;
    }
    static function add($id,$value){
				$query = "insert into `cloto_text` set 
				id='$id',
				value='$value'";
    	$id = dbQueryId($query);
    	
    	return $id;
    }
    static function update($id, $value){
    	$query = "update `cloto_text` 
    		set `value`='$value' 
    		where `id`='$id'
    	limit 1";
    	$id = dbQueryId($query);
    	return $id;
    }
}
