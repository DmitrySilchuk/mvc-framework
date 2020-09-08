<?php


// load classes
spl_autoload_register(function ($className) {
    $filename = strtolower($className) . '.php';
    // define a class and find a path for it
    $expArr = explode('_', $className);
    if(empty($expArr[1]) OR $expArr[1] == 'Base'){
        $folder = 'classes';
    }else{
        switch(strtolower($expArr[0])){
            case 'controller':
                $folder = 'controllers';
                break;

            case 'model':
                $folder = 'models';
                break;

            default:
                $folder = 'classes';
                break;
        }
    }
    // classpath
    $file = SITE_PATH . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $filename;
    // check for class availability
    if (file_exists($file) == false) {
        return false;
    }
    // include the file with the class
    include ($file);
    return true;
});


// start registry
$registry = new Registry;