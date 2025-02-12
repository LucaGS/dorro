<?php

spl_autoload_register(function ($class) {
    // Debug information
    error_log("Attempting to load class: " . $class);
    
    // Base directory is the current directory
    $baseDir = __DIR__;
    
    // Convert namespace separators to directory separators
    // Remove the 'App' prefix from the path since it's already in the directory structure
    $relativePath = str_replace('App\\', '', $class);
    $file = $baseDir . '/' . str_replace('\\', '/', $relativePath) . '.php';
    
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


