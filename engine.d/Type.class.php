<?php
class Type{
	function __construct($argument){}
	//
	static function drop($id){
  	$query = "delete from `cloto_type` where `id`='$id' limit 1";
  	$id = dbQueryId($query);
		return $id;
	}
	static function list($q="",$f="",$b=false){
		$query = "select * from cloto_type";
		$result = dbQuery($query);
		
		return $result;
	}
	static function padrao($tipoInt){
		switch ($tipoInt) {
		    case '1': return "label";
		    case '2': return "number";
		    case '3': return "text";
		}
		return false;
	}
	static function get($id){
    $query = "SELECT * FROM cloto_type where id = '$id';";
    return dbQuery($query)[0];
	}
	static function getByName($name){
    $query = "SELECT * FROM cloto_type where name = '$name';";
    $resut = dbQuery($query);
    //var_dump($resut);
    if(empty($resut)) return false;
    return $resut[0];
	}
	static function add($name){
  	echo $query = "insert into `cloto_type` set 
  		id=null,
  		nome='$name',
  		uso='0',
  		padrao='0'
  	";
  	$id = dbQueryId($query);
  	return $id;
	}
  static function update($id, $name, $meta){
  	$query = "update `cloto_type` set `criterios`='$meta' where `id`='$id'";
  	$id = dbQueryId($query);
  	return true;
  }
  //---------------- Meta -------------
  static function metasOf($idType){
		 $query = "SELECT 
		 	cloto_typemetas.id,
		 	cloto_typemetas.indice,
		 	cloto_typemetas.tipo,
		 	cloto_typemetas.type as typeid,
		 	
		 	cloto_label.value as rotulo_value 	
		 	
		 FROM cloto_typemetas
		 INNER JOIN cloto_label ON cloto_label.id = cloto_typemetas.rotulo
		 WHERE type = $idType
		 order by cloto_typemetas.indice asc
		 ;
		 ";
		 return dbQuery($query);
  }
  //posso adicionar o mesmo meta, para varios objetos?
  static function metaAdd($idDado){
  	//rotulo
  	$rotuloId = Dado::add(1,"none");
  	//
  	$query = "insert into `cloto_typemetas` set 
  		rotulo=$rotuloId, 
  		type=$idDado, 
  		indice=1, 
  		tipo=1,
  		modo=0
  	";
  	return dbQueryId($query);
  }
  static function metadrop($id){
  	$query = "delete from `cloto_typemetas` where `id`='$id'";
  	$id = dbQueryId($query);
		return $id;
  }
  static function metaUpdate($id,$rotulo,$tipo, $modo, $index){
  	echo $query = "UPDATE cloto_typemetas SET 
  		`tipo` = '$tipo'	,
  		`modo` = '$modo',
  		`indice` = '$index'
  	WHERE id = '$id'
  	;";
		dbQueryId($query);
		return true;
  }
}
