<?php

function getDatabaseConnection() {
    // Initialisierung der MySQLi-Verbindung
    $con = mysqli_init();

    // SSL-Zertifikat für die Verbindung setzen
    mysqli_ssl_set(
        $con,
        NULL, // Client-Key
        NULL, // Client-Zertifikat
        __DIR__ . "/../DigiCertGlobalRootCA.crt.pem", // CA-Zertifikat
        NULL, // Zertifikatspfad (falls vorhanden)
        NULL  // Schlüsselpfad (falls vorhanden)
    );

    // Aufbau der Verbindung zur Azure MySQL-Datenbank
    if (mysqli_real_connect(
        $con,
        "dorro-server.mysql.database.azure.com", // Hostname
        "svvaolmvjl",                           // Benutzername
        "xk$^6.q@,9?MB-8",                     // Passwort
        "dorro",                                // Datenbankname
        3306,                                   // Port
        MYSQLI_CLIENT_SSL                       // Verbindung über SSL
    )) {
        // Erfolgreiche Verbindung zurückgeben
        return $con;
    } else {
        // Fehlerfall: Fehlermeldung ausgeben und Skript beenden
        die("Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error());
    }
}
function getDatabaseConnection2() {
    // Verbindung zur MySQL-Datenbank mit Umgebungsvariablen
    $con = mysqli_connect(
        $_ENV["DB_HOST"],     // Hostname
        $_ENV["DB_USERNAME"], // Benutzername
        $_ENV["DB_PASSWORD"], // Passwort
        $_ENV["DB_DATABASE"], // Datenbankname
        intval($_ENV["DB_PORT"])
            
    );

    // Überprüfung der Verbindung
    if ($con) {
        return $con;
    } else {
        die("Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error());
    }
}
?>
