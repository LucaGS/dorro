<?php

// Define the function outside the autoloader
function listDirectoryContents($dir, $indent = '') {
    if (!is_dir($dir)) {
        error_log("WARNING: Not a directory: " . $dir);
        return;
    }
    
    error_log("Scanning directory: " . $dir);
    $files = scandir($dir);
    
    if ($files === false) {
        error_log("ERROR: Failed to scan directory: " . $dir);
        return;
    }
    
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

spl_autoload_register(function ($class) {
    error_log("\n=== Starting Autoloader ===");
    error_log("Attempting to load class: " . $class);
    error_log("Current directory (__DIR__): " . __DIR__);
    
    // First, let's list all directories
    error_log("\n=== Directory Structure ===");
    listDirectoryContents(__DIR__);
    error_log("=== End Directory Structure ===\n");
    
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
    error_log("\n=== File Search ===");
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


