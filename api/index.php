<?php
namespace PHPMaker2020\sistema_academia;

// Set up relative path
$RELATIVE_PATH = "../";
include_once $RELATIVE_PATH . "autoload.php";

// Create language object
$Language = new Language();
$Api = new Api();
$Api->run();
?>