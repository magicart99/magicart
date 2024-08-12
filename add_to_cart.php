<?php
session_start();
include 'db.php';

if (isset($_POST['producto_id']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['imagen']) && isset($_POST['cantidad'])) {
    $producto_id = $_POST['producto_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];
    $cantidad = $_POST['cantidad'];

    // Asegurarse de que el usuario esté logueado y el ID del usuario esté en la sesión
    if (isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];
        
        // Preparar e insertar los datos en la tabla carrito
        $sql = "INSERT INTO carrito (usuario_id, producto_id, nombre, descripcion, precio, imagen, cantidad) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissdsi", $usuario_id, $producto_id, $nombre, $descripcion, $precio, $imagen, $cantidad);

        if ($stmt->execute()) {
            // Redirigir de nuevo a la página de productos
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Error</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
            <style>
                body {
                    font-family: 'Montserrat', sans-serif;
                    background-color: #E3CD01;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
                
                .error-container {
                    background-color: #fff;
                    padding: 40px;
                    border-radius: 10px;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }
                
                h1 {
                    color: #333;
                    font-size: 24px;
                    font-weight: 700;
                    margin-bottom: 20px;
                }
                
                p {
                    color: #555;
                    font-size: 16px;
                    margin-bottom: 30px;
                }
                
                .login-btn {
                    display: inline-block;
                    background-color: #007bff;
                    color: #fff;
                    text-decoration: none;
                    padding: 12px 24px;
                    border-radius: 5px;
                    font-size: 16px;
                    font-weight: 600;
                    transition: background-color 0.3s ease;
                }
                
                .login-btn:hover {
                    background-color: #0056b3;
                }

                .volver-btn {
    display: inline-block;
    background-color: #28a745; /* Color verde */
    color: #fff;
    text-decoration: none;
    padding: 12px 24px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 600;
    transition: background-color 0.3s ease;
    position: fixed; /* Posicionar el botón de forma fija */
    bottom: 20px; /* Ajusta la distancia desde el fondo de la página */
    left: 20px; /* Ajusta la distancia desde la izquierda de la página */
}

.volver-btn:hover {
    background-color: #218838; /* Color verde más oscuro al pasar el ratón */
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
      <a class="navbar-brand" href="#"><img src="img/LOGOTIPO1.png" alt="Logo" class="logo"></a>
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
            <div class="error-container">
                <h1>Error</h1>
                <p>Usuario no logueado. Por favor, inicia sesión para continuar.</p>
                <a href="login.php" class="login-btn">Iniciar Sesión</a>
            </div>
            <a href="inicio.php" class="volver-btn">Volver al Inicio</a>
        </body>
        </html>
        <?php
        exit();
    }
} else {
    echo "Faltan datos para agregar el producto al carrito.";
}
?>
