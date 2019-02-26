<?php
class ControllerNumeros extends BaseController
{
    function aleatorios($n=10){
        $this->data = ModelNumeros::comoTuQuieras($n);
    }
}
?>
