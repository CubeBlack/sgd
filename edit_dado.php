<?php 
	require_once("engine.php");
	// pegar valores
	if(isset($_GET["id"]))$id = $_GET["id"];
		else $id = 0;
	$dado = Dado::Get($id);
	$dado["msg"] = "Dado carregado";
	//-------- Ações ---------------------
	//atualizar
	if(isset($_GET["a"])) $a = $_GET["a"];
		else $a = "";
	//salvar dado
	if($a == "s"){
		$value = $_GET["value"];
		$saveCheck = Dado::Update($id,$value);
		$dado = Dado::Get($id);
		if(!$saveCheck) $conteudo = "Erro!";
		else $dado["msg"] = "ok";
	}
	//apagar dado
	if($a == "drop"){
		$check = Dado::drop($id);
		if(!$check) $conteudo = "Erro!";
		else header("Location: list_dados.php");
	}
	///------ exibir pagina ---------
	$conteudo = Page::setTemplate("form_dado_{$dado["tipo"]}",$dado);
	$page->setName("Editar dado");
	$page->setContent($conteudo);
	$page->write();


