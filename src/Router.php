<?php

class Router {

    protected $uri;

    protected $controller;

    protected $action;

    protected $params;

    public function getUri() {
        return $this->uri;
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function getParams() {
        return $this->params;
    }

    public function __construct($uri) {

        if($uri == "/") {
            $this->redirect(Config::get("ruta.defecto"));
        }

        // Quitamos la barra del final
        $this->uri = urldecode(trim($uri, '/'));

        // Quitamos la parte de los parámetros GET
        $uri_parts = explode('?', $this->uri);

        // De la forma /controller/action/param1/param2/.../...
        $path = trim($uri_parts[0], '/');
        $path_parts = explode('/', $path);

        if ( count($path_parts) ) {

            // Obtenemos controlador
            if ( current($path_parts) ) {
                $this->controller = current($path_parts);
                array_shift($path_parts);
            }

            // Obtenemos acción
            if ( current($path_parts) ) {
                $this->action = current($path_parts);
                array_shift($path_parts);
            }

            // El resto son parámetros
            $this->params = $path_parts;
        }

        // Los parámetros POST, URL, COOKIE y SESSION estarán en sus variables
        // php correspondientes.
    }

    public static function redirect($location) {
        header("Location: $location");
    }
}

?>
