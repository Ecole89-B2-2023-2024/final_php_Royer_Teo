<?php

$dsn="mysql:dbname=final_php;host=localhost;charset=utf8";
$username="root";
$password="";

try {
    $pdo = new PDO($dsn, $username, $password);
} catch(Exception $erreur) {
    echo "<h1>Erreur de connexion</h1>";
    var_dump($erreur->getMessage());
    exit();
}