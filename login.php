<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT id, contrasena FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($contrasena, $hashed_password)) {
        $_SESSION['usuario_id'] = $id;
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        echo "<p style='text-align: center; color: red;'>Usuario o contraseña incorrectos.</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1EC7CD;
            margin: 0;
            overflow: hidden;
        }

        #background-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%; 
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
            background-size: cover;
        }

        .container {
            position: relative;
            z-index: 1;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        form h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        input[type="text"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #5cb85c;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        .navbar .logo {
            width: 45px;
            height: 45px;
        }

        .registrarse {
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
            color: black;
        }

        .registrarse a {
            color: blue;
            text-decoration: none;
        }

        .registrarse a:hover {
            text-decoration: underline;
        }

        .navbar a {
            color: #333;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 16px;
            font-weight: bold; /* Cambiado a 'bold' para negritas */
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #ff6b6b;
        }
    </style>
</head>
<body>
    <!-- Background Video -->
    <video autoplay muted loop id="background-video">
        <source src="img/fondo.mp4" type="video/mp4">
        Tu navegador no soporta videos en HTML5.
    </video>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="inicio.php"><img src="img/LOGOTIPO1.png" alt="Logo" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inicio.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Carrito</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Inicio Sesion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.html">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="acercade.html">Acerca de</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario de inicio de sesión -->
    <div class="container">
        <form method="post">
            <h2>Iniciar sesión</h2>
            Usuario: <input type="text" name="usuario" required><br>
            Contraseña: <input type="password" name="contrasena" required><br>
            <input type="submit" value="Iniciar sesión">
            <div class="registrarse">
                No tienes cuenta? <a href="register.php">registrate!</a>
            </div>
        </form>
    </div>
</body>
</html>
