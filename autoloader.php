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
    
    // Convert namespace separators to directory separators
    $relativePath = str_replace('App\\', '', $class);
    $paths = [
        __DIR__ . '/' . str_replace('\\', '/', $relativePath) . '.php',                     // Try without /app prefix
        __DIR__ . '/App/' . str_replace('\\', '/', $relativePath) . '.php',                // Try with uppercase App
        __DIR__ . '/app/' . str_replace('\\', '/', $relativePath) . '.php',                // Try with lowercase app
        strtolower(__DIR__ . '/' . str_replace('\\', '/', $relativePath) . '.php'),        // Try lowercase path
        strtolower(__DIR__ . '/App/' . str_replace('\\', '/', $relativePath) . '.php'),    // Try lowercase with uppercase App
        strtolower(__DIR__ . '/app/' . str_replace('\\', '/', $relativePath) . '.php'),    // Try lowercase with lowercase app
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
    
    error_log("\n=== File not found ===");
    error_log("Tried the following paths:");
    foreach ($paths as $path) {
        error_log("- " . $path);
    }
    
    throw new Exception("Die Klasse $class konnte nicht geladen werden. " .
                       "Überprüfte Pfade:\n" . implode("\n", $paths));
});
