<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit;

}


echo "Bienvenido, " . $_SESSION["username"];

echo "<br><a href='logout.php'>Cerrar sesión</a>";

?>