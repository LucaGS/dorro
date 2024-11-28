<?php
// Überprüfen, ob der Parameter 'name' in der URL übergeben wurde


$con = mysqli_init();
mysqli_ssl_set(mysql: $con,key: NULL,certificate: NULL, ca_certificate: "C:\dev\dorro\DigiCertGlobalRootCA.crt.pem", ca_path: NULL, cipher_algos: NULL);
if(mysqli_real_connect(mysql: $conn, hostname: "dorro-server.mysql.database.azure.com", username: "svvaolmvjl", password: "{V6G52dgRBBQd$64$}", database: "{d-database}", port: 3306, socket: MYSQLI_CLIENT_SSL)){
   echo "connection succesfull";
}else{
    echo "Connection not succesfull";
}
var_dump($con);
?>
