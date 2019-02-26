<?php

/* Sección de constantes */
define('DS', DIRECTORY_SEPARATOR); // Util para poder desplegar en Win/Linux
define('ROOT', dirname(dirname(__FILE__))); // Raíz de nuestro proyecto

#define('ROOT', "/var/www/html/mvc_link"); // Raíz de nuestro proyecto

define('VIEWS_PATH', ROOT.DS.'resources'.DS.'view');

require_once(ROOT.DS.'src'.DS.'init.php');

echo Config::get("db.host") . "<BR>";


App::run($_SERVER['REQUEST_URI']);

/*
Codigo para procesar la información
session_start();
App::run($_SERVER['REQUEST_URI']);
*/

?>
