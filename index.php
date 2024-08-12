<?php
session_start();
include 'db.php';

$usuario = '';
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .content {
            position: relative;
            z-index: 1;
            color: white;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente para mejorar la legibilidad */
        }

        .navbar {
            background-color: #4CE486;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: #333;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 16px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #ff6b6b;
        }

        .container {
            padding: 40px;
            text-align: center;
        }

        .container h1 {
            color: #ffffff;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .container h2 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .products, .promotions, .reviews {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .product, .promotion, .review {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 300px;
            transition: transform 0.3s ease;
        }

        .product:hover, .promotion:hover {
            transform: translateY(-5px);
        }

        .product img, .promotion img {
            width: 100%;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .product img:hover, .promotion img:hover {
            transform: scale(1.05);
        }

        .product h3, .promotion h3 {
            color: #333;
            font-size: 20px;
            font-weight: 600;
            margin: 15px 0;
        }

        .product p, .promotion p, .review p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
        }

        .map {
            margin: 40px 0;
            width: 100%;
            height: 500px;
            border: 0;
        }

        .footer {
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .footer p {
      margin: 0;
      color: rgb(255, 36, 47); /* Color amarillo */
      font-size: 1.2em; /* Tamaño de fuente más grande */
      font-weight: bold; /* Texto en negrita */
    }

        .navbar .logo {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <video autoplay muted loop class="video-background">
        <source src="img/video2.mp4" type="video/mp4">
        Tu navegador no soporta la reproducción de video.
    </video>
    
    <div class="navbar content">
        <div>
            <a class="navbar-brand" href="#"><img src="img/LOGOTIPO1.png" alt="Logo" class="logo"></a>
            <a href="index.php">Inicio</a>
            <a href="inicio.php">Productos</a>
            <a href="cart.php">Carrito</a>
            <a href="acercade.html">Acerca De</a>
            <a href="contacto.html">Contacto</a>
        </div>
        <div>
            <?php if ($usuario): ?>
                <a href="logout.php">Cerrar sesión</a>
            <?php else: ?>
                <a href="login.php">Inicio de sesión</a>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="container content">
        <?php if ($usuario): ?>
            <h1>Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</h1>
        <?php else: ?>
            <h1>Bienvenido a MAGIC ART</h1>
        <?php endif; ?>
        <h2>Productos Destacados</h2>
        <div class="products">
            <div class="product">
                <img src="img/pinturas.jfif" alt="Producto 1">
                <h3>Pinturas</h3>
                <p>La mejor calidad de pinturas para pintar</p>
            </div>
            <div class="product">
                <img src="img/acuarelas.jpg" alt="Producto 2">
                <h3>Acuarelas</h3>
                <p>Las mejores acuarelas para los pequeños del hogar</p>
            </div>
            <div class="product">
                <img src="img/cuadros.jfif" alt="Producto 3">
                <h3>Cuadros</h3>
                <p>Venta de cuadros de los pintores más famosos</p>
            </div>
        </div>

        <h1>¡⚠️LLEGARON LAS PROMOCIONES DE AGOSTO⚠️!</h1>
        <h2>Promociones</h2>
        <div class="promotions">
            <div class="promotion">
                <img src="img/acuarelas.jpg" alt="Promoción 1">
                <h3>Descuento en Acuarelas</h3>
                <p>Todas las acuarelas con un 20% de descuento</p>
            </div>
            <div class="promotion">
                <img src="img/lapices.jpg" alt="Promoción 2">
                <h3>Oferta en Lápices</h3>
                <p>Lápices al 50% de descuento</p>
            </div>
            <div class="promotion">
                <img src="img/libretas.jfif" alt="Promoción 3">
                <h3>Oferta en Libretas</h3>
                <p>¡Todas las libretas al 90% de descuento!</p>
            </div>
        </div>

        <h1>¿Dónde se encuentra MAGIC ART?</h1>
        
        <iframe class="map" src="https://maps.google.com/maps?q=Colonia%20Lázaro%20Cárdenas%2C%20Montemorelos%2C%20Nuevo%20León%2C%20México&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>

        <h2>Reseñas de Clientes</h2>
        <div class="reviews">
            <div class="review">
                <p><strong>Alan Z.:</strong> "Los productos son de excelente calidad, especialmente las pinturas.★★★★★"</p>
            </div>
            <div class="review">
                <p><strong>Juan CR.:</strong> "Compré algunos pinceles y acuarelas para mi hijo y le encantaron, muy buena variedad.★★★★★"</p>
            </div>
            <div class="review">
                <p><strong>El Camarón:</strong> "La verdad no pensé que los cuadros fueran de famosos, quedé fascinado con el cuadro de Diego Rivera.★★★★★"</p>
            </div>
        </div>
    </div>

    <div class="footer content">
        &copy; 2024 MAGIC ART. Todos los derechos reservados.
    </div>
</body>
</html>
