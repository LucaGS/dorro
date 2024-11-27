<?php
// Verbindungsdetails
$servername = getenv('AZURE_MYSQL_HOST'); // Hostname von Azure DB
$username = getenv('AZURE_MYSQL_USERNAME'); // Benutzername
$password = getenv('AZURE_MYSQL_PASSWORD'); // Passwort
$dbname = getenv('AZURE_MYSQL_DBNAME'); // Datenbankname
$port = getenv('AZURE_MYSQL_PORT'); // Port (standardmäßig 3306)

// Verbindung mit MySQL herstellen
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
} 

echo "Erfolgreiche Verbindung zur MySQL-Datenbank!";
?>
