<?php

spl_autoload_register(function ($class) {
    // Debug information
    error_log("Attempting to load class: " . $class);
    
    // Base directory is one level up from autoloader
    $baseDir = __DIR__ . '/App';
    
    // Convert namespace separators to directory separators
    $file = $baseDir . '/' . str_replace('\\', '/', $class) . '.php';
    
    // Debug information
    error_log("Looking for file: " . $file);
    error_log("File exists: " . (file_exists($file) ? 'true' : 'false'));
    
    // If file exists, require it
    if (file_exists($file)) {
        require_once $file;
        error_log("Successfully loaded: " . $file);
        return true;
    }
    error_log("Autoloader versucht zu laden: " . $class);
    throw new Exception("Die Klasse $class konnte nicht geladen werden. " .
                       "Überprüfte Pfade:\n" . $file);
});

