<?php
class Dado{
	static function drop($id){
    $query = "SELECT tipo FROM cloto_id where id = '$id';";
    $tipo = dbQuery($query)[0]["tipo"];
  	$query = "
  		delete from `cloto_id` where `id`='$id' limit 1;
  		delete from `cloto_{$tipo}` where `id`='$id' limit 1;
  	";
  	$id = dbQueryId($query);
		return true;
	}
    //a ideia do filtro...
    static function list($q="",$f=""){
    	$query = "select 
					cloto_id.id,
					cloto_id.tipo,
					cloto_type.nome AS tipo_nome,
					
					if(cloto_id.tipo = '1',cloto_label.value,
						if(cloto_id.tipo = '2',cloto_number.value,
							if(cloto_id.tipo = '3',cloto_text.value,'[object]')
						)
					) as value
				from cloto_id
				
				left join cloto_label on cloto_id.id = cloto_label.id
				left join cloto_number on cloto_id.id = cloto_number.id
				left join cloto_text on cloto_id.id = cloto_text.id
				left join cloto_object on cloto_id.id = cloto_object.id
				
				INNER JOIN cloto_type ON cloto_id.tipo = cloto_type.id
			;";
    	$retorno = dbQuery($query);

    	return $retorno;

    }
    static function add($tipoInt, $value){
    	$userId = User::id();
    	$query = "INSERT `cloto_id` SET 
					`id` = null,
					`uso` = 0,
					`tipo`='$tipoInt',
					`criacao`=now(),
					`user`=$userId
				;";
			$id = dbQueryId($query);
			if($tipoStr = Type::padrao($tipoInt)){
				$query = "INSERT `cloto_$tipoStr` SET 
					`id` = $id,
					`value`='$value' 
				;";
				dbQueryId($query);
			}else{
				Page::error("Não foi posivel reconhecer o tipo: $tipo");
			}

      return $id;
    }
    static function get($id){
    	$query = "select 
					cloto_id.id,
					cloto_id.tipo,
					cloto_type.nome AS tipo_nome,
					
					if(cloto_id.tipo = '1',cloto_label.value,
						if(cloto_id.tipo = '2',cloto_number.value,
							if(cloto_id.tipo = '3',cloto_text.value,'[object]')
						)
					) as value
				from cloto_id
				left join cloto_label on cloto_id.id = cloto_label.id
				left join cloto_number on cloto_id.id = cloto_number.id
				left join cloto_text on cloto_id.id = cloto_text.id
				left join cloto_object on cloto_id.id = cloto_object.id
				
				INNER JOIN cloto_type ON cloto_id.tipo = cloto_type.id
				
				WHERE cloto_id.id = $id
			;";
    	$retorno = dbQuery($query);

    	return $retorno[0];
    }
    static function update($id, $value){
      $query = "SELECT tipo FROM cloto_id where id = '$id';";
      $tipoInt = dbQuery($query)[0]["tipo"];
			if($tipoStr = Type::padrao($tipoInt)){
				$query = "UPDATE `cloto_$tipoStr` 
					set `value`='$value' 
					where `id`='$id'";
				$retorno = dbQueryId($query);
			}else{
				Page::error("Não foi posivel reconhecer o tipo: $tipo");
			}
			Dado::addUso($id);
      return true;
    }
    static function addUso($id,$add=1){
    	$query = "SELECT uso FROM cloto_id where id = '$id';";
      $uso = (int)dbQuery($query)[0]["uso"];
      $uso += $add;
      $query = "UPDATE cloto_id SET uso = $uso WHERE id = '$id';";
      dbQueryId($query);
      return true;
    }
}

