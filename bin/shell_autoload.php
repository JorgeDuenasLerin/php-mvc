<?php

// Aplicación funcione en linux y win
define('DS', DIRECTORY_SEPARATOR);

// Raíz del proyecto. Independiente de la situación
define('ROOT', dirname(dirname(__FILE__)));
define('VIEW_ROOT', ROOT.DS."resources".DS);

require (ROOT.DS."src".DS."init.php");

App::initDB();

/*
https://stackoverflow.com/questions/26473168/php-interactive-load-file-from-command-line
*/


?>
