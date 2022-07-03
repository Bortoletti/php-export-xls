<?php

$sql_host = "";
$sql_db = "";
$sql_usr = "";
$sql_pwd = "";

$sql_conn_str = "pgsql:dbname=" . $sql_db . ";host=" . $sql_host;

$conn = new PDO( $sql_conn_str, $sql_usr, $sql_pwd ); 
$conn->setAttribute(PDO::ATTR_ERRMODE, $conn::ERRMODE_EXCEPTION);
//pg_set_client_encoding($conn, "LATIN1");


?>
