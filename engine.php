<?php
/*
Scrip para juntar dependencias do motor
*/
//dependencias
include_once "config.php";
include_once "engine.d/functions.php";

$page = new Page();
$page->menuAddItem("Dados","list_dados.php");
$page->menuAddItem("Novo dado","add_dado.php");
$page->menuAddItem("Tipos","list_tipos.php");
$page->menuAddItem("Novo Tipo","add_tipo.php");
$page->menuAddItem("Sobre","view_sobre.php");
//mudar o "perfil" para o nome do usuario
$page->menuAddItem("Perfil","view_perfil.php");
//


///------------
