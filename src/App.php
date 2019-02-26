<?php

// src/App.php
class App {

    protected static $router;
    public static $db;

    public static function getRouter() {
        return self::$router;
    }

    public static function initDB() {
        self::$db = new DB(Config::get('db.user'), Config::get('db.password'), Config::get('db.db_name'), Config::get('db.host'));
    }

    public static function getDB(){
        return self::$db;
    }

    public static function run($uri) {
        self::$router = new Router($uri);
        self::initDB();



        $controller_class = 'Controller'.ucfirst(self::$router->getController());
        $controller_method = self::$router->getAction();
        $controller_params = self::$router->getParams();

        $controller_object = new $controller_class();
        if ( method_exists($controller_object, $controller_method) ) {
            $controller_output = $controller_object->processAction($controller_method, $controller_params);
            // Controller's action may return a view path
            /*$view_path = $controller_object->$controller_method();
            $view_object = new View($controller_object->getData(), $view_path);
            $content = $view_object->render();*/
        } else {
            throw new Exception('Method '.$controller_method.' of class '.$controller_class.' does not exist.');
        }

        echo $controller_output;
        /*
        $layout_path = VIEWS_PATH.DS.$layout.'.html';
        $layout_view_object = new View(compact('content'), $layout_path);
        echo $layout_view_object->render();
        */
    }
}

?>
