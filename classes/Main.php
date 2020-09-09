<?php


abstract class Main {

    protected $registry;
    protected $template;
    protected $layouts;

    public $vars = [];

    //connect templates in the constructor
    function __construct($registry) {
        $this->registry = $registry;
        $this->template = new Template($this->layouts, get_class($this));
    }

    abstract function actionIndex();
}