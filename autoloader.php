<?php

spl_autoload_register(function ($class) {
    // Convert the class name to lowercase for case-insensitive comparison
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR;
    $relativeClass = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $class);
    
    // First try the exact case
    $file = $baseDir . $relativeClass . '.php';
    
    // If file doesn't exist, try lowercase version
    if (!file_exists($file)) {
        $file = $baseDir . strtolower($relativeClass) . '.php';
    }

    if (file_exists($file)) {
        require_once $file;
    } else {
        // Fehlerbehandlung bei fehlender Datei (optional)
        throw new Exception("Die Klasse $class konnte nicht geladen werden (Datei: $file).");
    }
});

