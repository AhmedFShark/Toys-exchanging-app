<?php
require("constants.php");

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

mysqli_set_charset($connection, "utf8");

if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>
