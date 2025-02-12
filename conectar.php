<?php

$host = "localhost";

$dbname = "login_db";

$username = "root";  // Cambia si es necesario

$password = "mariana26";  // Cambia si es necesario


try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Error en la conexión: " . $e->getMessage());

}

?>