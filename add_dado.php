<?php 
	require_once("engine.php");
	//----------- pegar valores
	//$tipo = (isset($_GET["tipo"]))?$_GET["tipo"]:"";
	$a = (isset($_GET["a"]))?$_GET["a"]:"";
	$value = (isset($_GET["value"]))?$_GET["value"]:"";
	$msg = "";
	//------- Ações -----------------
	//salvar dado
	if($a == "s"){
		$value = $_GET["value"];
		$tipo = $_GET["tipo"];
		$check = Dado::add($tipo,$value);
		if($check){
			$msg = "salvo";
			//header("Location: list_dados.php");	
		}else{
			$msg = "Erro ao salvar dado";
		}
		
	}
	//------- carregar formularios ------------
	if(isset($_GET["tipo"])){
		$tipo = $_GET["tipo"];
		if($tipo<10){
			$d = [
				"msg" => $msg,
				"value"=>$value,
				"id"=>""
			];
			$conteudo = Page::setTemplate("form_dado_$tipo",$d);
		}else{
			$conteudo = Page::setTemplate("form_dado_object",$d);
		}
	}
	else{
		$tiposArr = Type::list();
		$tiposHTML = "";
		foreach ($tiposArr as $key => $value) {
		    $tiposHTML.=Page::setTemplate("form_dado_selecttipo_tipo",$value);
		}
		$d=[
			"tipos"=>$tiposHTML
		];
		$conteudo = Page::setTemplate("form_dado_selectttipo",$d);
	}


	//---------- pagina -----------
	$page->setName("Novo tipo");
	$page->setContent($conteudo);
	$page->write();


