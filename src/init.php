<?php


function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}


spl_autoload_register(function ($class) {
    $classPath = ROOT.DS."src".DS;

    if(startsWith($class,"Controller")) {
        $classPath .= "controller".DS;
    } elseif(startsWith($class,"Model")) {
      $classPath .= "model".DS;
    } elseif(startsWith($class,"Field")) {
      $classPath .= "field".DS;
    }

    require("$classPath${class}.php");
});

require_once(ROOT.DS."config".DS."config.php");

?>
