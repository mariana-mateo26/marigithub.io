<?php
require 'conectar.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        echo "<script>
                localStorage.setItem('username', '$username');
                window.location.href = 'dist/pages/index.html';
              </script>";
        exit;
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
    }
}
?>



<form method="POST">

    <input type="text" name="username" placeholder="Usuario" required><br>

    <input type="password" name="password" placeholder="Contraseña" required><br>

    <button type="submit">Iniciar Sesión</button>
    

</form>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        /* Estilos generales */
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #080710;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%,-50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#1845ad,rgb(11, 255, 113));
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right,rgb(255, 47, 161),rgb(128, 62, 122));
            right: -30px;
            bottom: -80px;
        }

        form {
            height: 450px;
            width: 400px;
            background-color: rgba(255,255,255,0.13);
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
            text-align: center;
        }

        form * {
            font-family: 'Poppins',sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 20px;
            font-size: 16px;
            font-weight: 500;
            text-align: left;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255,255,255,0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
            margin-top: 40px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #e0e0e0;
        }

        .error-message {
            color: #ff5252;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<form method="POST">
    <h3>Iniciar Sesión</h3>

    <label for="username">Usuario</label>
    <input type="text" name="username" placeholder="Ingrese su usuario" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" placeholder="Ingrese su contraseña" required>

    <button type="submit" id="registerButton">Ingresar</button>
    
    <a href="registrar.php">Volver</a>';
    <?php
    if (!empty($error_message)) {
        echo '<div class="error-message">' . $error_message . '</div>';
    }
    ?>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesa los datos aquí si es necesario
    // Por ejemplo, puedes verificar la contraseña, etc.
    
    // Redirigir a la carpeta del dashboard
    header('Location: ../dist/pages/index.html');
    exit();
}
?>
</body>
</html>
