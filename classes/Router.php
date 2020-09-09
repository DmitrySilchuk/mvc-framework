<?php


class Router {

    private $registry;
    private $path;
    private $args = [];

    // get registry
    public function __construct($registry) {
        $this->registry = $registry;
    }

    // set the path for the folder with controllers
    public function setPath($path) {
        $path = trim($path, '/\\');
        $path .= DIRECTORY_SEPARATOR;
        // if the path doesn't exist
        if (is_dir($path) == false) {
            throw new Exception ('Invalid controller path: `' . $path . '`');
        }
        $this->path = $path;
    }

    // defining controller and action from URL
    private function getController(&$file, &$controller, &$action, &$args) {
        $route = empty($_SERVER['PATH_INFO']) ? '' : $_SERVER['PATH_INFO'];

        if (empty($route)) {
            $route = 'Default';
        }
        // get parts of url
        $route = trim($route, '/\\');
        $parts = explode('/', $route);

        // find the controller
        $controllersDirectory = $this->path;
        foreach ($parts as $part) {
            $fullpath = $controllersDirectory;

            // Checking for folder existence
            if (is_dir($fullpath . $part)) {
                $controllersDirectory .= $part . DIRECTORY_SEPARATOR;
                array_shift($parts);
                continue;
            }

            // find the file
            if (is_file($fullpath . ucfirst($part) . 'Controller.php')) {
                $controller = ucfirst($part) . 'Controller';
                array_shift($parts);
                break;
            }
        }

        // if urle does not specify a controller, then use the default index
        if (empty($controller)) {
            $controller = 'Default';
        }

        // get the action
        $action = array_shift($parts);
        if (empty($action)) {
            $action = 'actionIndex';
        }
        else {
            $action = 'action' . ucfirst($action);
        }

        $file = $controllersDirectory . $controller . '.php';
        $args = $parts;
    }

     public function start() {
        // analyzing the path
        $this->getController($file, $controller, $action, $args);

        // Check for file existence, otherwise 404
        if (is_readable($file) == false) {
            die ('404 Not Found');
        }

        // connecting the file
        include ($file);

        // Instantiating the controller
        $controller = new $controller($this->registry);

        // If the action doesn't exist - 404
        if (is_callable([$controller, $action]) == false) {
            die ('404 Not Found');
        }

        // executing the action
        $controller->$action();
    }
}