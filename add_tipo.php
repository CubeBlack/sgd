<?php 
	require_once("engine.php");
	//-------- valores -------------
	$a = (isset($_GET["a"]))?$_GET["a"]:"";
	$msg = "";
	//-------- Açẽos --------------
	//salvar
	if ($a== "s") {
		$nome = $_GET["nome"];
		$id = Type::add($nome);
		if($id){
			header("Location: edit_tipo.php?id=$id");
		}
		else $msg="Erro ao salvar";
	}
	//---------- pagina -----------
	$d=[
		"msg"=>$msg
	];
	$conteudo = Page::setTemplate("form_tipoadd",$d);
	$page->setName("Novo tipo");
	$page->setContent($conteudo);
	$page->write();
