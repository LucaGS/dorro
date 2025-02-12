<?php

spl_autoload_register(function ($class) {
    // Convert namespace separators to directory separators
    $baseDir = __DIR__;
    
    // Handle the 'App' namespace specifically
    $prefix = 'App\\';
    
    // Check if the class uses our namespace prefix
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }
    
    // Get the relative class name
    $relativeClass = substr($class, strlen($prefix));
    
    // Convert class name to a file path
    $file = $baseDir . '/App/' . str_replace('\\', '/', $relativeClass) . '.php';
    
    // If the file exists, require it
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    
    // If exact case doesn't exist, throw an informative error
    throw new Exception("Die Klasse $class konnte nicht geladen werden (Datei: $file). " .
                       "Bitte überprüfen Sie Groß-/Kleinschreibung von Verzeichnissen und Dateien.");
});

