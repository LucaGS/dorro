<?php
function getDatabaseConnection() {
    $con = mysqli_init();
    mysqli_ssl_set(
        $con,
        NULL,
        NULL,
        __DIR__ . "/../DigiCertGlobalRootCA.crt.pem",
        NULL,
        NULL
    );

    if (mysqli_real_connect(
        $con,
        "dorro-server.mysql.database.azure.com",
        "svvaolmvjl",
        "V6G52dgRBBQd$64$",
        "dorro",
        3306,
        MYSQLI_CLIENT_SSL
    )) {
        return $con;
    } else {
        die("Fehler bei der Verbindung zur Datenbank: " . mysqli_connect_error());
    }
}
?>
