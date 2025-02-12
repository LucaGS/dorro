<?php

spl_autoload_register(function ($class) {
    // Debug information
    error_log("Attempting to load class: " . $class);
    
    // Convert namespace separators to directory separators
    $baseDir = __DIR__;
    
    // Remove 'App\' from the beginning if it exists
    $class = str_ireplace('App\\', '', $class);
    
    // Try multiple path variations
    $possibilities = [
        // Standard path
        $baseDir . '/App/' . str_replace('\\', '/', $class) . '.php',
        // Lowercase path
        $baseDir . '/app/' . strtolower(str_replace('\\', '/', $class)) . '.php',
        // Direct path
        $baseDir . '/' . str_replace('\\', '/', $class) . '.php',
    ];
    
    // Debug: show all paths being checked
    foreach ($possibilities as $path) {
        error_log("Checking path: " . $path);
        error_log("File exists: " . (file_exists($path) ? 'true' : 'false'));
    }
    
    // Try to require the first file that exists
    foreach ($possibilities as $path) {
        if (file_exists($path)) {
            require_once $path;
            error_log("Successfully loaded: " . $path);
            return true;
        }
    }
    
    // If we get here, no file was found
    throw new Exception("Die Klasse $class konnte nicht geladen werden. " .
                       "Überprüfte Pfade:\n" . implode("\n", $possibilities));
});

