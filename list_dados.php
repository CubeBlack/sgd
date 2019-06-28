<?php 
	require_once("engine.php");
	//--------- variaveis
	$q = (isset($_GET["q"]))? $_GET["q"]:"";
	$result = Dado::list($q);
	$conteudo = "";
	//-------
	$dadosHTML = "";
	foreach($result as $i){
		$dadosHTML.=Page::setTemplate("list_dados_dados",$i);
	}
	if(empty($result)) $dadosHTML .= "Nada encontrado";
	//------- mostrar pagina ---------- 
	$d = [
		"dados"=>$dadosHTML
	];
	$conteudo = Page::setTemplate("list_dados",$d);
	$page->setContent($conteudo);
	$page->setName("Dados");
	$page->write();


