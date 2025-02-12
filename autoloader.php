<?php

spl_autoload_register(function ($class) {
    // Debug information
    error_log("Attempting to load class: " . $class);
    error_log("Current directory (__DIR__): " . __DIR__);
    
    // Recursive directory listing function
    function listDirectoryContents($dir, $indent = '') {
        $results = [];
        $files = scandir($dir);
        
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            
            $path = $dir . '/' . $file;
            error_log($indent . "- " . $file);
            
            if (is_dir($path)) {
                error_log($indent . "  Directory contents:");
                listDirectoryContents($path, $indent . "    ");
            }
        }
    }
    
    // List complete directory structure
    error_log("Complete directory structure from " . __DIR__ . ":");
    listDirectoryContents(__DIR__);
    
    // Base directory is the current directory
    $baseDir = __DIR__;
    
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


