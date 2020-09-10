<?php


// load classes
spl_autoload_register(function ($className) {

    // define a class and find a path for it
    if (endsWith( $className, 'Controller' )) {
        $folder = 'controllers';
    }
    else if (endsWith( $className, 'Model' ) && $className != 'MainModel') {
        $folder = 'models';
    }
    else {
        $folder = 'classes';
    }

    // classpath
    $file = SITE_PATH . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $className . '.php';
    // check for class availability
    if (file_exists($file) == false) {
        return false;
    }
    // include the file with the class
    include ($file);
    return true;
});

function endsWith( $haystack, $needle ) {
    $length = strlen( $needle );
    if( !$length ) {
        return true;
    }
    return substr( $haystack, -$length ) === $needle;
}

function makeIndexedArrayById($arr) {
    $indexedArray = [];
    foreach ($arr as $item) {
        $indexedArray[$item[0]] = $item[1];
    }

    return $indexedArray;
}

// start registry
$registry = new Registry;