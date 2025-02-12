<?php
include '../../conectar.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo "Usuario no encontrado.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    if (isset($_POST['id'], $_POST['username'], $_POST['password'])) {
        $id = $_POST['id'];
        $username = trim($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña

        $sql = "UPDATE users SET username = :username, password = :password WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . implode(", ", $stmt->errorInfo());
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Editar Usuario</h1>
        <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($row['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Nueva Contraseña" required>
            </div>
            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            header("Location: index.html");

            <a href="index.html" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
