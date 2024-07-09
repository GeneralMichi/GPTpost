<?php
$serverName = "GENERALMICHI";
$connectionOptions = array(
    "Database" => "gptpost",
    "Uid" => "",
    "PWD" => ""
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Connection successful!";
}
?>
