<?php

$host = "localhost";
$dbname = "weatherblog_db";
$username = "root";
$password = "123456";

try {
    //data source name
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);

    //error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //default fetch mode to associated array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die('Connection Failed: ' . $e->getMessage());
}