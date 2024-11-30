<?php
try {
    // Verbindung mit der Datenbank herstellen (PDO)
    $dsn = 'mysql:host=dorro-server.mysql.database.azure.com;dbname=dorro;port=3306';
    $username = 'svvaolmvjl';
    $password = 'V6G52dgRBBQd$64$';
    
    // Optionen für PDO (einschließlich SSL-Verbindung)
    $options = [
        PDO::MYSQL_ATTR_SSL_KEY    => NULL, // Optional: Dein SSL-Schlüssel
        PDO::MYSQL_ATTR_SSL_CERT   => NULL, // Optional: Dein SSL-Zertifikat
        PDO::MYSQL_ATTR_SSL_CA     => __DIR__ . "/DigiCertGlobalRootCA.crt.pem", // CA-Zertifikat
    ];

    // PDO-Instanz erstellen
    $pdo = new PDO($dsn, $username, $password, $options);

    // Setze den Fehler-Modus von PDO auf Ausnahme (Exception)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Erfolgreich mit der Datenbank verbunden!<br>";

    // SQL-Abfrage, um alle Daten aus der User-Tabelle abzurufen
    $query = "SELECT * FROM User";
    $stmt = $pdo->query($query);

    if ($stmt) {
        // Ergebnisse ausgeben
        echo "<table border='1'>";
        echo "<tr><th>UserId</th><th>Username</th><th>Password</th><th>Email</th><th>CreatedAt</th></tr>";

        // Durch die Ergebnisse iterieren und in der Tabelle anzeigen
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
        echo "Fehler bei der Abfrage.";
    }
} catch (PDOException $e) {
    // Fehlerbehandlung bei der Verbindung oder Abfrage
    echo "Fehler bei der Verbindung oder Abfrage: " . $e->getMessage();
}

// Verbindung schließen (PDO schließt die Verbindung automatisch am Ende des Skripts)
?>
