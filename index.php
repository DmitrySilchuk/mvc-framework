<?php


// connection config
include ('config.php');
// connection DB
try {
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// connection the core
include (SITE_PATH . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'core.php');

// load the router
$router = new Router($registry);
// writing data to the registry
$registry->set ('router', $router);
// set the path to the controller folder
$router->setPath (SITE_PATH . DIRECTORY_SEPARATOR . 'controllers');
// start the router
$router->start();
