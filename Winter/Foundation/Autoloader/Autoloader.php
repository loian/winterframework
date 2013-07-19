<?php

/*
 * Autoloader function.
 * Convert namespace of a class into a path
 * and open the template in the editor.
 */

function __autoload($class) {
    $parts = explode('\\', $class);
    $fileName = implode('/', $parts) . '.php';
    require $_SERVER["DOCUMENT_ROOT"] . '/../' . $fileName;
}

