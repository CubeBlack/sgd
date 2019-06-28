<?php 
	require_once("engine.php");
	//--------- variaveis
	$q = (isset($_GET["q"]))? $_GET["q"]:"";
	$result = Type::list($q);
	$conteudo = "";
	//-------
	$tiposHTML = "";
	foreach($result as $i){
		$tiposHTML.=Page::setTemplate("list_tipos_tipo",$i);
	}
	if(empty($result)) $tiposHTM .= "Nada encontrado";
	//------- mostrar pagina ---------- 
	$d = [
		"tipos"=>$tiposHTML
	];
	$conteudo = Page::setTemplate("list_tipos",$d);
	$page->setContent($conteudo);
	$page->setName("Tipos");
	$page->write();


