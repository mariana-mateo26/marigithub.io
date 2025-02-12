<?php
include '../../conectar.php'; // Asegúrate de que conectar.php define correctamente $pdo

// Agregar usuario
if (isset($_POST["agregar"])) {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hashear la contraseña

    if (!empty($username) && !empty($_POST["password"])) {
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
    }
    header("Location: index.html");
    exit();
}

// Editar usuario
if (isset($_POST["editar"])) {
    $id = intval($_POST["id"]);
    $username = trim($_POST["username"]);

    if (!empty($username)) {
        $sql = "UPDATE users SET username = :username WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    header("Location: index.html");
    exit();
}

// Eliminar usuario
if (isset($_GET["eliminar"])) {
    $id = intval($_GET["eliminar"]);
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    
    header("Location: index.html");
    exit();
}
?>
