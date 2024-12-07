<?php

spl_autoload_register(function ($class) {
    // Basisverzeichnis des Projekts
    $baseDir = __DIR__ . DIRECTORY_SEPARATOR ;

    // Namespace-Separator durch Directory-Separator ersetzen
    $relativeClass = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $class);

    // Datei mit vollständigem Pfad
    $file = $baseDir . $relativeClass . '.php';

    // Wenn die Datei existiert, einbinden
    if (file_exists($file)) {
        require_once $file;
    } else {
        // Fehlerbehandlung bei fehlender Datei (optional)
        throw new Exception("Die Klasse $class konnte nicht geladen werden (Datei: $file).");
    }
});

