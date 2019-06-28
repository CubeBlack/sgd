<?php 
	require_once("engine.php");
	//-------- valores -------------
	$id = $_GET["id"];
	$typeArr = Type::get($id);
	$metasHtml = "";
	$a = (isset($_GET["a"]))?$_GET["a"]:"";
	//-------- ações--------------
	//Adicionar meta
	if($a=="addmeta"){
		Type::metaAdd($id);
		$typeArr = Type::get($id);
	}
	//Atualizar meta
	if($a=="updatemeta"){
		Type::metaUpdate(
			$_GET["meta_id"],
			$_GET["rotulo"],
			$_GET["tipo"],
			$_GET["modo"],
			$_GET["index"]
		);
	}
	//Remove meta
	if($a=="dropmeta"){
		Type::metaDrop($_GET["meta_id"]);
	}
	//---------- pagina -----------
	//pegar metas
	$metasArr = Type::metasOf($id);
	//var_dump($metasArr);

	$tipos = Type::list();
	$typeArr["metasHtml"] = $tiposHtml  = "";
	foreach ($metasArr as $key => $value) {
		foreach ($tipos as $key => $t) {
			$adicional = ($t["id"]==$value["tipo"])?"selected":"";
			$d = [
				"label"=>$t["nome"],
				"value"=>$t["id"],
				"adicional"=>$adicional
			];
		  $tiposHtml.=Page::setTemplate("html_select_option",$d);
		}
		$value["tipooption"] = $tiposHtml;
		$value["tipo_id"] = $id;
		$typeArr["metasHtml"] .= Page::setTemplate("form_tipo_meta",$value);
	}
	
	$conteudo = Page::setTemplate("form_tipo",$typeArr);
	$page->setName("Editar Tipo {$typeArr["nome"]}");
	$page->setContent($conteudo);
	$page->write();
