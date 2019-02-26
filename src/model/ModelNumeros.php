<?php

class ModelNumeros extends BaseModel
{
    static function comoTuQuieras($n){
        $data = [];
        for($i=0;$i<$n;$i++){
            $data[]=rand(0,100);
        }
        return $data;
    }
}

?>
