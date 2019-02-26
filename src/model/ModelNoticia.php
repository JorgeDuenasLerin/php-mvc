<?php

/*

ModelNoticia::getNoticias(1);
$noticas = ModelNoticia::getNoticiasDesde('2019/01/01', 2);
$noticia = ModelNoticia::getById(4);

$noticia->getTitle();

$noticia->setTexto('Este es mi texto');
$noticia->save();




include('bin/shell_autoload.php');
$n = new ModelNoticia();
$n->setTitulo('Mi primera noticia');
$n->setTexto('Este es el cuerpo');
$n->setFecha('2019/02/05');
$n->save();

ModelXXXX::getAll();
ModelXXXX::getAll(1,10);
ModelXXXX::getAll(0,10);

ModelXXXX::getFiltradoPorYYYYYY('cosa', 0,10);

ModelNoticia::getFiltradoPorTexto('Trump')
ModelNoticia::getIgualTitulo('Noticia')



*/

class ModelNoticia extends BaseModel
{
    protected static $lista_info = ['id', 'titulo', 'texto', 'fecha'];
}

?>
