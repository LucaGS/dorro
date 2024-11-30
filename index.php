<?php
// Content-Type für JSON setzen
header("Content-Type: application/json");

// Verbindung initialisieren
$con = mysqli_init();
mysqli_ssl_set(
    $con,
    NULL, // Key
    NULL, // Zertifikat
    __DIR__ . "/DigiCertGlobalRootCA.crt.pem", // CA-Zertifikat
    NULL, // CA-Pfad
    NULL  // Verschlüsselungsalgorithmus
);

// Verbindung herstellen
if (mysqli_real_connect(
    $con,
    "dorro-server.mysql.database.azure.com", // Hostname
    "svvaolmvjl",                           // Benutzername
    "V6G52dgRBBQd$64$",                     // Passwort
    "d-database",                           // Datenbankname
    3306,                                   // Port
    MYSQLI_CLIENT_SSL                       // SSL-Verbindung
)) {
    // SQL-Abfrage, um alle Daten aus der User-Tabelle abzurufen
    $query = "SELECT UserId, Username, Email, CreatedAt FROM User";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Ergebnisse in ein Array speichern
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }

        // Ergebnisse als JSON ausgeben
        echo json_encode([
            "status" => "success",
            "data" => $users
        ]);
    } else {
        // Fehler bei der Abfrage
        echo json_encode([
            "status" => "error",
            "message" => "Fehler bei der Abfrage: " . mysqli_error($con)
        ]);
    }
} else {
    // Fehler bei der Verbindung zur Datenbank
    echo json_encode([
        "status" => "error",
        "message" => "Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error()
    ]);
}

// Verbindung schließen
mysqli_close($con);
?>
