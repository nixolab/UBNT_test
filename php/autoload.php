<?php

/**
 * Register PSR-4 autoloader
 */
spl_autoload_register(function ($class) {

    $prefix  = 'Ubnt\\Html\\';
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $filePath = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $len)) . '.php';

    if (file_exists($filePath)) {
        require $filePath;
    }
});