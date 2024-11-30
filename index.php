<?php


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
    "dorro",                           // Datenbankname
    3306,                                   // Port
    MYSQLI_CLIENT_SSL                       // SSL-Verbindung
)) {
    echo "Erfolgreich mit der Datenbank verbunden!<br>";

    // SQL-Abfrage, um alle Daten aus der User-Tabelle abzurufen
    $query = "SELECT * FROM User";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Ergebnisse ausgeben
        echo "<table border='1'>";
        echo "<tr><th>UserId</th><th>Username</th><th>Password</th><th>Email</th><th>CreatedAt</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['UserId']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Password']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['CreatedAt']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Fehler bei der Abfrage: " . mysqli_error($con);
    }
} else {
    echo "Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error();
}

// Verbindung schließen
mysqli_close($con);
?>