<?php
require_once "./config.php";

function sourceName($name){
  if(SHOWSOURCENAME){
    echo "[sourceName|$name] ";
  }
}

function carregaClasse($nomeDaClasse) {
       require_once("engine.d/".$nomeDaClasse.".class.php");
}
//
spl_autoload_register("carregaClasse");
/*
*
*/
function dbQueryID($query){
  try {
      $db = new PDO(
          "mysql:host=".DBHOSTNAME.";dbname=".DBHOSTDBNA."",
          DBHOSTUSER,
          DBHOSTPASS
      );
      $txtQuery = "select now()";
  } catch (PDOException $e) {
      print "<pre>Error(DBServer::construct)!".$e->getMessage();
      die();
  }

  $results = $db->query($query);
  
	$id = $db->lastInsertid();
	return $id;
}
/*

*/
//Querys ao db com retorno em Array
function dbQuery($query){


//SHOWDBASEQUERY 
if(SHOWDBASEQUERY)
    echo "[dbQuery|$query] ";
//
    try {
        $db = new PDO(
            "mysql:host=".DBHOSTNAME.";dbname=".DBHOSTDBNA."",
            DBHOSTUSER,
            DBHOSTPASS
        );
        $txtQuery = "select now()";
    } catch (PDOException $e) {
        print "<pre>Error(DBServer::construct)!".$e->getMessage();
        die();
    }

    $results = $db->query($query);
    if(SHOWDBASEERROR){
        $error = $db->errorInfo(); 
        echo $error[2];
    }
   $retorno = $results->fetchAll();
   //eliminar os numeros da resposta /// isso deve almentar o processamento
   if(empty($retorno)) return $retorno;
   $nTable = [];
   $nRow = [];
   foreach($retorno as $row ){
    foreach($row as $key => $campo){
      if(is_numeric($key))continue;
      $nRow[$key] = $campo;
    }
    $nTable[] = $nRow;
    $nRow = [];
   }
   return $nTable;
    
}
//b ekup no linux
function dbDump(){
    system('mysqldump -h host -u usuario --no-data --database banco > dump.sql -psenha');
}
sourceName("functions.php");


