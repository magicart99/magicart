<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove'])) {
    $producto_id = $_POST['producto_id'];

    $sql = "DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $stmt->execute();
    $stmt->close();
}

$sql = "SELECT * FROM carrito WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <style>
        body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(to right, #ff6b6b, #ffa500, #ffff00, #00ff00, #00ffff, #0000ff, #ff00ff);
  background-size: 600% 600%;
  animation: gradient 30s ease infinite;
  margin: 0;
  padding: 0;
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

.navbar {
  background-color: rgba(255, 255, 255, 0.8);
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
  font-weight: 500;
  font-weight: bold; /* Cambiado a 'bold' para negritas */;
  transition: color 0.3s ease;
}

.navbar a:hover {
  color: #ff6b6b;
}

.container {
  padding: 40px;
}

h1 {
  color: #fff;
  text-align: center;
  margin-top: 20px;
  font-size: 36px;
  font-weight: 700;
  text-shadow: 
    -1px -1px 0 rgba(0, 0, 0, 0.5),  
    1px -1px 0 rgba(0, 0, 0, 0.5),
    -1px 1px 0 rgba(0, 0, 0, 0.5),
    1px 1px 0 rgba(0, 0, 0, 0.5),
    2px 2px 4px rgba(0, 0, 0, 0.5);
}


table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 40px;
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

th, td {
  padding: 20px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #00008b;
  color: #fff;
  font-size: 18px;
  font-weight: 600;
}

td {
  font-size: 16px;
  font-weight: 500;
}

tr:hover {
  background-color: rgba(255, 255, 255, 0.9);
}

.total-row {
  font-weight: 600;
}

.checkout-btn {
  display: block;
  width: 200px;
  margin: 40px auto;
  padding: 15px;
  text-align: center;
  background-color: #00008b;
  color: #fff;
  text-decoration: none;
  border-radius: 5px;
  font-size: 18px;
  font-weight: 600;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s ease;
}

.checkout-btn:hover {
  background-color: #e53935;
}

.remove-btn {
  background-color: #e53935;
  color: #fff;
  border: none;
  padding: 10px 15px;
  text-align: center;
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s ease;
}

.remove-btn:hover {
  background-color: #c62828;
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

.navbar .logo {
  width: 50px;
  height: 50px;
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
    
    bottom: 20px; /* Ajusta la distancia desde el fondo de la página */
    left: 20px; /* Ajusta la distancia desde la izquierda de la página */
}

.volver-btn:hover {
    background-color: #218838; /* Color verde más oscuro al pasar el ratón */
}
    </style>
</head>
<body>
    <div class="navbar">
        <div>
        <a class="navbar-brand" href="#"><img src="img/LOGOTIPO1.png" alt="Logo" class="logo"></a>
        <a href="index.php">Inicio</a>
        <a href="inicio.php">Productos</a>
        </div>
        <div>
        <a href="logout.php">Cerrar sesión</a>
        </div>
    </div>

    <div class="container">
        <h1>Carrito de Compras</h1>
        <table>
            <tr>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
            <?php
            $total = 0;
            while($row = $result->fetch_assoc()) {
                $subtotal = $row['precio'] * $row['cantidad'];
                $total += $subtotal;
                echo "<tr>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>$" . $row['precio'] . "</td>";
                echo "<td>" . $row['cantidad'] . "</td>";
                echo "<td>$" . $subtotal . "</td>";
                echo "<td>
                        <form method='post'>
                            <input type='hidden' name='producto_id' value='" . $row['producto_id'] . "'>
                            <input type='submit' name='remove' value='Eliminar' class='remove-btn'>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
            <tr class="total-row">
                <td colspan="5">Total</td>
                <td>$<?php echo $total; ?></td>
            </tr>
        </table>
        <a href="checkout.php" class="checkout-btn">Proceder al Pago</a>
        <a href="index.php" class="volver-btn">Comprar otra cosa</a>
    </div>
    
    <div class="footer">
        &copy; 2024 MAGIC ART. Todos los derechos reservados.
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
