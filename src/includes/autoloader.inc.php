<?php
spl_autoload_register('autoLoader');

function autoLoader($className)
{
    $path = "src/classes/";
    $extensions = ".class.php";
    $fullPath = $path . $className . $extensions;

    if (!file_exists($fullPath)) {
        return false;
    }

    require_once $fullPath;
}
