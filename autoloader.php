<?php

spl_autoload_register(function ($class) {
    // Debug information
    error_log("Attempting to load class: " . $class);
    error_log("Current directory (__DIR__): " . __DIR__);
    
    // List all directories and files in current directory
    error_log("Directory contents of " . __DIR__ . ":");
    $files = scandir(__DIR__);
    foreach ($files as $file) {
        error_log(" - " . $file);
    }
    
    // Base directory is the current directory
    $baseDir = __DIR__ . '/app';  // Changed to include /app directory
    
    // List contents of /app directory if it exists
    if (is_dir($baseDir)) {
        error_log("Directory contents of " . $baseDir . ":");
        $appFiles = scandir($baseDir);
        foreach ($appFiles as $file) {
            error_log(" - " . $file);
        }
    } else {
        error_log("Warning: /app directory not found at " . $baseDir);
    }
    
    // Convert namespace separators to directory separators
    // Remove the 'App' prefix from the path since it's already in the directory structure
    $relativePath = str_replace('App\\', '', $class);
    $file = $baseDir . '/' . str_replace('\\', '/', $relativePath) . '.php';
    
    // Try lowercase version if original doesn't exist
    if (!file_exists($file)) {
        $lowerFile = strtolower($file);
        if (file_exists($lowerFile)) {
            $file = $lowerFile;
        }
    }
    
    // Also try without /app if file not found
    if (!file_exists($file)) {
        $altFile = __DIR__ . '/' . str_replace('\\', '/', $relativePath) . '.php';
        if (file_exists($altFile)) {
            $file = $altFile;
        }
    }
    
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


