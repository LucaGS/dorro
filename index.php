<?php
// Überprüfen, ob der Parameter 'name' in der URL übergeben wurde
if (isset($_GET['name'])) {
    $name = $_GET['name'];  // Den Wert des Parameters 'name' auslesen
    echo "Hallo, " . htmlspecialchars($name) . "!";
} else {
    echo "Bitte gib deinen Namen in der URL an, z. B. ?name=John";
}

$con = mysqli_init();
mysqli_ssl_set(mysql: $con,key: NULL,certificate: NULL, ca_certificate: "C:\dev\dorro\DigiCertGlobalRootCA.crt.pem", ca_path: NULL, cipher_algos: NULL);
if(mysqli_real_connect(mysql: $conn, hostname: "dorro-server.mysql.database.azure.com", username: "svvaolmvjl", password: "V6G52dgRBBQd$64$", database: "d-database", port: 3306, socket: MYSQLI_CLIENT_SSL)){}
var_dump($con);
?>
