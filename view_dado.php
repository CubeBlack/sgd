<?php 
	require_once("engine.php");
	//fazer pesquisa
	$id = $_GET["id"];
	$dado = Dado::get($id);
	//var_dump($dado);
	$conteudo = Page::setTemplate("dado".$dado["tipo"],$dado);

	//criar pagina
	$d = [
		"page"=>"Search",
		"conteudo"=>$conteudo
	];
	echo Page::setTemplate("page", $d);


