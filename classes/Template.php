<?php


class Template
{
    private $controller;
    private $layouts;
    private $vars = [];

    public function __construct($layouts, $controllerName) {
        $this->layouts = $layouts;
        $this->controller = $controllerName;
    }

    // setting variables to display
    public function vars($varname, $value) {
        if (isset($this->vars[$varname]) == true) {
            trigger_error ('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);
            return false;
        }
        $this->vars[$varname] = $value;
        return true;
    }

    // view
    public function view($name) {
        $pathLayout = SITE_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . $this->layouts . '.php';
        $contentPage = SITE_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $this->getControllerFolderName() . DIRECTORY_SEPARATOR . $name . '.php';
        if (file_exists($pathLayout) == false) {
            trigger_error ('Layout `' . $this->layouts . '` does not exist.', E_USER_NOTICE);
            return false;
        }
        if (file_exists($contentPage) == false) {
            trigger_error ('Template `' . $name . '` does not exist.', E_USER_NOTICE);
            return false;
        }

        foreach ($this->vars as $key => $value) {
            $$key = $value; // $hello = $this->vars['hello']; dynamical creating variable
        }

        include ($pathLayout);
    }

    private function getControllerFolderName()
    {
        return strtolower(str_replace('Controller', '', $this->controller));
    }
}