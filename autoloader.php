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
    $baseDir = __DIR__ . '/app';
    
    // Convert namespace separators to directory separators
    $relativePath = str_replace('App\\', '', $class);
    $paths = [
        $baseDir . '/' . str_replace('\\', '/', $relativePath) . '.php',                    // Try with /app prefix
        __DIR__ . '/' . str_replace('\\', '/', $relativePath) . '.php',                     // Try without /app prefix
        strtolower($baseDir . '/' . str_replace('\\', '/', $relativePath) . '.php'),       // Try lowercase with /app prefix
        strtolower(__DIR__ . '/' . str_replace('\\', '/', $relativePath) . '.php'),        // Try lowercase without /app prefix
    ];
    
    error_log("\n=== Trying paths ===");
    foreach ($paths as $path) {
        error_log("Checking path: " . $path);
        if (file_exists($path)) {
            error_log("Found file at: " . $path);
            require_once $path;
            return true;
        }
    }
    
    // If we get here, we've tried all paths and found nothing
    error_log("\n=== File not found ===");
    error_log("Tried the following paths:");
    foreach ($paths as $path) {
        error_log("- " . $path);
    }
    
    throw new Exception("Die Klasse $class konnte nicht geladen werden. " .
                       "Überprüfte Pfade:\n" . implode("\n", $paths));
});
});