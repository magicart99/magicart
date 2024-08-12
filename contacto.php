<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto - Tienda de Artes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      color: #fff;
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
      background: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente para mejorar la legibilidad */
      padding: 20px;
      min-height: 100vh; /* Asegura que el contenido tenga al menos la altura de la ventana */
    }
    .navbar, .footer {
      background-color: rgba(0, 0, 0, 0.8); /* Fondo semi-transparente para la barra de navegación y pie de página */
    }
    .container {
      margin-top: 100px; /* Espacio superior para evitar que el contenido quede debajo de la navbar */
    }

    .navbar {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 1px;
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
  </style>
</head>
<body>
  <video autoplay muted loop class="video-background">
    <source src="img/video2.mp4" type="video/mp4">
    Tu navegador no soporta la reproducción de video.
  </video>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="img/LOGOTIPO1.png" alt="Logo" class="logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="inicio.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Carrito</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Inicio Sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="contacto.html">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="acercade.html">Acerca de</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contacto -->
  <div class="container content mt-5 pt-5">
    <h2 class="text-center my-5">Contáctanos</h2>
    <div class="row">
      <div class="col-md-6">
        <form action="send_contact.php" method="post">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
      </div>
      <div class="col-md-6">
        <h4>Nuestras Oficinas</h4>
        <p>Dirección: Colonia Anita S/N, Montemorelos, Nuevo León</p>
        <p>Teléfono: (826) 123-7890</p>
        <p>Correo Electrónico: magic@art.com</p>
        <div class="mt-4">
          <h5>Síguenos en nuestras redes sociales:</h5>
          <h5>FACEBOOK:</h5>
          <a href="https://clipartspub.com/images/facebook-logo-clipart-vector-8.png" class="text-white me-3">Magic art Oficial<i class="fab fa-facebook-f"></i></a>
          <h5>INSTAGRAM:</h5>
          <a href="https://pixabay.com/id/vectors/instagram-aplikasi-koleksi-logo-1675670/" class="text-white me-3">☑MAGIC ART<i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer bg-dark text-white mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p>&copy; 2024 Tienda de Arte. Todos los derechos reservados.</p>
        </div>
        <div class="col-md-6 text-end">
          <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
