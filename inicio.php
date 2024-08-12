<?php
session_start();
include 'db.php';

// Consulta para obtener los productos
$sql = "SELECT id, nombre, descripcion, precio, imagen FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .background-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%; 
            min-height: 100%;
            z-index: -1;
            filter: brightness(0.5); /* Ajusta el brillo si es necesario */
        }

        .navbar {
            background-color: #343a40;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            margin: 0 5px;
            font-weight: bold;
        }

        .navbar a:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        .container {
            padding: 20px;
            text-align: center;
            color: #fff; /* Color del texto blanco para mejor visibilidad */
        }

        .container h1 {
            color: #fff;
            margin-bottom: 20px;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .product {
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 250px;
            transition: transform 0.3s;
        }

        .product:hover {
            transform: scale(1.05);
        }

        .product img {
            width: 100%;
            border-radius: 10px;
        }

        .product h3 {
            color: #343a40;
            margin: 10px 0;
        }

        .product p {
            color: #6c757d;
        }

        .product form {
            margin-top: 10px;
        }

        .product label {
            display: block;
            margin-bottom: 5px;
            color: #343a40;
        }

        .product input[type="number"] {
            width: 50px;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .product input[type="submit"] {
            background-color: #343a40;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .product input[type="submit"]:hover {
            background-color: #495057;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <video autoplay muted loop class="background-video">
        <source src="img/fondo.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <div class="navbar">
        <div>
            <a href="index.php">Inicio</a>
            <a href="inicio.php">Productos</a>
            <a href="cart.php">Carrito</a>
            <a href="acercade.html">Acerca De</a>
            <a href="contacto.html">Contacto</a>
        </div>
        <div>
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="logout.php">Cerrar sesión</a>
            <?php else: ?>
                <a href="login.php">Inicio de sesión</a>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="container">
        <h1>Productos Disponibles</h1>
        <div class="products">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                    <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                    <p><?php echo htmlspecialchars($row['descripcion']); ?></p>
                    <p>$<?php echo number_format($row['precio'], 2); ?></p>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="producto_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>">
                        <input type="hidden" name="descripcion" value="<?php echo htmlspecialchars($row['descripcion']); ?>">
                        <input type="hidden" name="precio" value="<?php echo $row['precio']; ?>">
                        <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($row['imagen']); ?>">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidad" value="1" min="1" required>
                        <input type="submit" value="Agregar al carrito">
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="footer">
        &copy; 2024 MAGIC ART. Todos los derechos reservados.
    </div>
</body>
</html>
