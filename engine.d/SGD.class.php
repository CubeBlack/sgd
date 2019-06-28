<?php
class SGD{
	static function select($q="",$l="10",$tReturn=""){
		$dados = Dado::list();
		if($tReturn == "json"){
			return $dados;
		}
		else if($tReturn == "html"){
			SGD::erro("SGD::select()<br>Tipo indefido");
		}
		return $dados;
		
	}
	static function insert($id, $d){
	}
	static function update($id, $d){
	}
	static function erro($ms){
		echo "Errro: $msg";
		die();
	}
}
