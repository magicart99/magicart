<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // Guardar la imagen en la carpeta "img"
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fotografia"]["name"]);
    move_uploaded_file($_FILES["fotografia"]["tmp_name"], $target_file);

    $sql = "INSERT INTO usuarios (usuario, contrasena, fecha_nacimiento, fotografia) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $usuario, $contrasena, $fecha_nacimiento, $target_file);

    if ($stmt->execute()) {
        $message = "<p style='text-align: center; color: green;'>Registro exitoso.</p>";
    } else {
        $message = "<p style='text-align: center; color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ff6b6b, #ffa500, #ffff00, #00ff00, #00ffff, #0000ff, #ff00ff);
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-top: 130px; /* Agregado para separar del navbar */
        }

        form h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        input[type="text"], input[type="password"], input[type="date"], input[type="file"] {
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

        .message {
            text-align: center;
            margin-top: 20px;
        }

        .navbar .logo {
            width: 45px;
            height: 45px;
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

    <div class="form-container">
        <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>
        <form method="post" enctype="multipart/form-data">
            <h2>Registro de Usuario</h2>
            Usuario: <input type="text" name="usuario" required><br>
            Contraseña: <input type="password" name="contrasena" required><br>
            Fecha de nacimiento: <input type="date" name="fecha_nacimiento" required><br>
            Fotografía: <input type="file" name="fotografia" required><br>
            <input type="submit" value="Registrar">
        </form>
        
    </div>
    
</body>
</html>
