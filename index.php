<?php
// Überprüfen, ob der Parameter 'name' in der URL übergeben wurde
if (isset($_GET['name'])) {
    $name = $_GET['name'];  // Den Wert des Parameters 'name' auslesen
    echo "Hallo, " . htmlspecialchars($name) . "!";
} else {
    echo "Bitte gib deinen Namen in der URL an, z. B. ?name=John";
}

$con = mysqli_init();
mysqli_ssl_set($con,NULL,NULL, "C:\dev\dorro\DigiCertGlobalRootCA.crt.pem", NULL, NULL);
mysqli_real_connect($conn, "dorro-server.mysql.database.azure.com", "svvaolmvjl", "{V6G52dgRBBQd$64$}", "{d-database}", 3306, MYSQLI_CLIENT_SSL);
?>
