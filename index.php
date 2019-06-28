<?php 
	require_once("engine.php");
	//fazer pesquisa
	$q = "";
	$result = SGD::select($q);
	// criar conteudo
	$conteudo = Page::setTemplate("inicio");
	//criar pagina

	$page->setContent($conteudo);
	$page->setName("Inicio");
	$page->write();



