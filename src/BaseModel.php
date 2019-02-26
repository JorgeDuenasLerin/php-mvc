<?php

class BaseModel {

    protected $db;
    protected static $lista_info;

    private $data;

    private function estaEnListaDatos($nombre) {
        return in_array($nombre, static::$lista_info);
    }

    /***
      setAlgo, setOtracosa
      getAlgo, getOtracosa
    */
    public function __call($nombre, $dato) {
        $dato_pedido = strtolower(substr ($nombre , 3));
        $accion = substr ( $nombre , 0, 3);
        if(!$this->estaEnListaDatos($dato_pedido)){
            return "ERROR";
        }

        if($accion == "get" ){
            return $this->data[$dato_pedido];
        } else if($accion == "set" ){
            $this->data[$dato_pedido] = $dato[0];
        }
    }

    public function __construct($data_row = []) {
        $this->db = App::getDB();

        if(count($data_row)==0){
            $this->data = array_fill_keys(static::$lista_info, null);
        } else {
            $this->data = array_combine(static::$lista_info, $data_row);
        }
    }

    public static function getAll($page = 0, $num = 10){
        $db = App::getDB();

        $nombre_clase = get_called_class();
        $nombre_tabla = strtolower(substr($nombre_clase,5));
        $campos_para_select = implode(",", static::$lista_info);

        //echo "SELECT $campos_para_select FROM $nombre_tabla";
        $resultado = $db->ejecutar("SELECT $campos_para_select FROM $nombre_tabla");
        //print_r($resultado);
        $resultado = array_map(function ($datos) {
            $nombre_clase = get_called_class();
            return new $nombre_clase($datos);
        }, $resultado);
        return $resultado;
    }

    public static function getById($id){
        $db = App::getDB();

        $nombre_clase = get_called_class();
        $nombre_tabla = strtolower(substr($nombre_clase,5));
        $campos_para_select = implode(",", static::$lista_info);

        $resultado = $db->ejecutar("SELECT $campos_para_select FROM $nombre_tabla WHERE id = ?", $id);
        return new $nombre_clase($resultado[0]);
    }

    public function save() {
        $db = App::getDB();

        $nombre_clase = get_called_class();
        $nombre_tabla = strtolower(substr($nombre_clase,5));

        $campos = array_slice(static::$lista_info,1);
        $parametros = array_fill(0,count(static::$lista_info)-1,'?');

        if($this->getId() == null) {
            $campos_para_insert = implode(",", $campos);
            $parametros_para_insert = implode(",", $parametros);
            $sql_insert = "INSERT INTO $nombre_tabla ($campos_para_insert) VALUES ($parametros_para_insert)";

            $resultado = $this->db->ejecutar($sql_insert, ...array_values(array_slice($this->data,1)));

            if(is_array($resultado)){
                $this->setId($this->db->getLastId());
                $resultado[] = $this->getId();
            }
            return $resultado;
        } else {
            $campos_update = array_map(function($nombre, $interrogante){
                return $nombre . '=' . $interrogante;
            }, $campos, $parametros);

            $texto_campos_update = implode(",", $campos_update);
            $datos_para_consulta = array_values(array_slice($this->data,1));
            $datos_para_consulta[] = $this->data['id'];
            $sql_update = "UPDATE $nombre_tabla SET $texto_campos_update WHERE id = ?";

            $resultado = $this->db->ejecutar(
                        $sql_update,
                        ...$datos_para_consulta
                      );

            if(is_array($resultado)){
                $resultado[] = $this->getId();
            }
            return $resultado;
        }
    }

    public function toArray() {
        return $this->data;
    }
}

?>
