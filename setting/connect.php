<?php
$db_database = 'myabroad_database';
$db_username = 'root';
$db_password = 'password';
$dsn = 'localhost';
//接続
$mysqli = new mysqli($dsn, $db_username, $db_password, $db_database);
if($mysqli->connect_error){
    die('conect_error('.$mysqli->conect_errno.')'.$mysqli->conect_error);
}
// echo 'Success... ' . $mysqli->host_info . "<br>";
// printf("Initial character set: %s", $mysqli->character_set_name() . "<br>");
$mysqli->set_charset('utf8');
// printf("converted character set: %s", $mysqli->character_set_name() . "<br>");
?>
