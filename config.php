<?php
/*
configração do sistama
*/
// MODO DE MANUTENÇÃO
define("SHOWSOURCENAME",false);
define("SHOWDBASEERROR",false);
define("SHOWDBASEQUERY",false);
//
define("TEMABASEPATH","tema.d");
//define("TEMA","simple");
define("TEMANAME","novo");
//
define("DBHOSTNAME","localhost");
define("DBHOSTUSER","root");
define("DBHOSTPASS","");
define("DBHOSTDBNA","lima");
//

$show_sourcename = false;

require_once("engine.d/functions.php");
sourceName("config.php");
