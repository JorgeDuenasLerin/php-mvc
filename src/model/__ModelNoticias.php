<?php

/*

ModelNoticia::getNoticias(1);
ModelNoticia::getNoticiasDesde('2019/01/01', 2);
$noticia = ModelNoticia::getById(4);

$noticia->getTitle();

$noticia->setTexto('Este es mi texto');
$noticia->save();




include('bin/shell_autoload.php');
$n = new ModelNoticias();
$n->setTitulo('Mi primera noticia');
$n->setTexto('Este es el cuerpo');
$n->setFecha('2019/02/05');
$n->save();


*/

class ModelNoticias extends BaseModel
{
    private $id;
    private $titulo;
    private $texto;
    private $fecha;

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function save() {
        if($this->id == null) {
            $resultado = $this->db->ejecutar("INSERT INTO noticias (titulo, texto, fecha) VALUES (?, ?, ?)",
                          $this->titulo,$this->texto,$this->fecha);
            if(is_array($resultado)) {
                $this->id = $this->db->getLastId();
                return [$this->id];
            } else {
                return $resultado;
            }
        } else {
            return $this->db->ejecutar("UPDATE noticias SET titulo = ?, texto = ?, fecha = ? WHERE id = ?",
                        $this->titulo,$this->texto,$this->fecha, $this->id);
        }
    }
}

?>
