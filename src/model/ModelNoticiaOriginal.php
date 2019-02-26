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


*/

class ModelNoticia extends BaseModel
{
    private $id; //
    private $titulo;
    private $texto;
    private $fecha;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

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

    public function __construct($data_row = []) {
        parent::__construct();
        if(count($data_row)>0){
            $this->setId($data_row['id']);
            $this->setTitulo($data_row['titulo']);
            $this->setTexto($data_row['texto']);
            $this->setFecha($data_row['fecha']);
        }
    }

    public function save() {
        if($this->id == null) {
            $resultado = $this->db->ejecutar("INSERT INTO noticias (titulo, texto, fecha) VALUES (?, ?, ?)",
                          $this->titulo, $this->texto, $this->fecha);
            if(is_array($resultado)){
                $this->setId($this->db->getLastId());
                $resultado[] = $this->getId();
            }
            return $resultado;
        } else {
            $resultado = $this->db->ejecutar("UPDATE noticias SET titulo = ?, texto = ?, fecha = ? WHERE id = ?",
                        $this->titulo, $this->texto, $this->fecha, $this->id);
            if(is_array($resultado)){
                $resultado[] = $this->getId();
            }
            return $resultado;
        }
    }

    public static function getAllNoticias($page = 0, $num = 10){
        $db = App::getDB();
        $resultado = $db->ejecutar("SELECT id, titulo, texto, fecha FROM noticias");
        $resultado = array_map(function ($datos) {
            return new ModelNoticia($datos);
        }, $resultado);
        return $resultado;
    }
}

?>
