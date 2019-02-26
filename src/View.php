<?php

class View {

    private $data;
    private $path;

    private static function getViewPath() {
        $router = App::getRouter();
        $controller_dir = $router->getController();
        $template_name = $router->getAction().'.phtml';
        return VIEWS_PATH.DS.$controller_dir.DS.$template_name;
    }

    public function __construct($data = array()) {
        $path = self::getViewPath();

        if ( !file_exists($path) ) {
            throw new Exception('Template file is not found in path: '.$path);
        }

        $this->path = $path;
        $this->data = $data;
    }

    public function render() {
      $base_layout_path = VIEWS_PATH.DS.'base.phtml';
      $data['title'] = Config::get('site_name');
      $data['contenido'] = $this->renderRAW();
      ob_start();
      include($base_layout_path);
      $content_html = ob_get_clean();
      echo $content_html;
    }

    public function renderRAW() {
        $data = $this->data;

        // Crea un buffer para procesar la salida
        ob_start();
        // Incluye nuestro html con php
        // lo renderiza en el buffer
        include($this->path);
        // mete el contenido del resultado en la variable content
        $content = ob_get_clean();

        return $content;
    }

}

?>
