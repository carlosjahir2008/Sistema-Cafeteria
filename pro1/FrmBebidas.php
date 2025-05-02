<!DOCTYPE html>
<html lang="es">

<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['nivel'] > 3) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos (ajusta tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemacafeteria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario de agregar comida
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_comida'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO menu_bebidas (nombre, precio, imagen, descripcion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdss", $nombre, $precio, $imagen, $descripcion);

    if ($stmt->execute()) {
        $mensaje = "Comida agregada correctamente.";
    } else {
        $mensaje = "Error al agregar la comida: " . $stmt->error;
    }
    $stmt->close();
}

// Eliminar comida
if (isset($_GET['eliminar'])) {
    $id_eliminar = $_GET['eliminar'];
    $sql_eliminar = "DELETE FROM menu_bebida WHERE id = ?";
    $stmt_eliminar = $conn->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("i", $id_eliminar);
    if ($stmt_eliminar->execute()) {
        $mensaje_eliminar = "Comida eliminada correctamente.";
    } else {
        $mensaje_eliminar = "Error al eliminar la comida: " . $stmt_eliminar->error;
    }
    $stmt_eliminar->close();
}

// Obtener el menú de la base de datos
$sql_menu = "SELECT id, nombre, precio, imagen, descripcion FROM menu_bebidas";
$result_menu = $conn->query($sql_menu);
$menu = [];
if ($result_menu->num_rows > 0) {
    while ($row = $result_menu->fetch_assoc()) {
        $menu[] = $row;
    }
}

$conn->close();
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Principal</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #0d745b;
            background-image: url('./iconos/backgroud-imagen.png');
            background-size: 200px;
            color: #333;
        }

        .encabezado {
            background-color: rgb(11, 96, 56);
            color: whitesmoke;
            padding: 20px;
            font-size: 2.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .izq {
            display: flex;
            gap: 15px;
            margin-right: 10px;
        }

        .circulo {
            width: 45px;
            height: 45px;
            background-color: beige;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .info {
            background-color: rgb(11, 123, 71);
            display: flex;
            justify-content: flex-end;

            box-sizing: border-box;
            padding: 10px 10px;

        }



        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 1.3rem;
            color: #0b604b;
            margin-bottom: 5px;
        }

        .card p {
            font-size: 0.95rem;
            margin-bottom: 10px;
            color: #555;
        }

        .card span {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #0b604b;
        }

        .card button {
            background-color: #0b604b;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .card button:hover {
            background-color: #0d745b;
        }

        footer.foot {

            background-color: rgb(11, 96, 56);
            color: beige;
            text-align: center;
            padding: 15px;
            font-size: 0.95rem;

        }

        .selecion {

            font-weight: 550;
            margin-top: 20px;
            width: 100%;
            display: flex;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;

        }

        .seleccion-div {
            display: flex;
            justify-content: center;

            background-color: rgba(11, 96, 56, 0.17);
            border-radius: 20px;
            backdrop-filter: blur(1px);
        }

        .Opcion {
            width: 120px;
            text-align: center;
            color: beige;
            margin: 20px 10px 20px 10px;
            padding: 10px 15px 10px 15px;
            background-color: #0b604b;
            border-radius: 40px;
            text-decoration: none;
        }

        .Opcion:first-child {
            background-color: rgba(65, 110, 99, 0.29);
            color: rgba(0, 0, 0, 0.44);
        }

        .menu_button {
            color: #fffacf;
            font-size: 18px;
            position: absolute;
            z-index: 2001;
            top: 100px;
            right: 95vw;
            left: 20px;
            min-width: 120px;
            min-height: 40px;
            background-color: rgba(16, 74, 45, 0.49);


            border-radius: 20px;
            border: none;
            transition: top 0.3s ease;

        }

        .menu_button.abierto {

            top: 20px;


        }


        .menu {
            position: fixed;
            top: 0px;

            left: -250px;
            width: 250px;
            height: 100%;
            background-color: #13a35b;
            padding-top: 70px;
            transition: left 0.3s ease;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        .menu ul {
            list-style-type: none;
            padding: 0;
        }

        .menu ul li {
            padding: 15px 20px;
        }

        .menu ul li a {
            color: #fffacf;
            text-decoration: none;
            font-size: 18px;
        }

        .menu.abierto {
            left: 0;
        }


        .agregar-comida-form {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            text-align: left;
        }

        .agregar-comida-form h2 {
            color: #0b604b;
            margin-bottom: 15px;
            text-align: center;
        }

        .agregar-comida-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .agregar-comida-form input[type="text"],
        .agregar-comida-form input[type="number"],
        .agregar-comida-form textarea {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        .agregar-comida-form button[type="submit"] {
            background-color: #0b604b;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .agregar-comida-form button[type="submit"]:hover {
            background-color: #0d745b;
        }

        .mensaje {
            color: green;
            margin-top: 10px;
            text-align: center;
        }

        .mensaje-error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }

        .card-acciones {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            justify-content: center;
        }

        .card-acciones button {
            background-color: #dc3545;
            /* Rojo para eliminar */
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 25px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .card-acciones button.modificar {
            background-color: rgba(171, 202, 15, 0.77);
            /* Azul para modificar */
        }

        .card-acciones button:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>

    <div class="encabezado">
        Cafeteria
    </div>

    <header>
        <button id="btn-menu" class="menu_button">☰ Menu</button>
        <div class="info">
            <div class="izq">
                <a href="carrito.php">
                    <div class="circulo">
                        <img src="./iconos/carrito.png" alt="Carrito" width="25px">
                    </div>
                </a>
                <a href="config_cuenta.php">
                    <div class="circulo">
                        <img src="./iconos/usuario.png" alt="Usuario" width="25px">
                    </div>
                </a>
            </div>
        </div>
    </header>

    <nav id="menu-lateral" class="menu">
        <ul>
            <?php if ($_SESSION['nivel'] < 3) : ?>
                <li><a href="index_encargado.php">Incio encargado</a></li>
            <?php endif; ?>
            <li><a href="index_comida.php">Inicio</a></li>
            <li><a href="config_cuenta.php">Cuenta</a></li>
            <li><a href="#">Configuracion</a></li>
            <?php if ($_SESSION['nivel'] < 3) : ?>
                <li><a href="#">Estadisticas</a></li>
            <?php endif; ?>
            <li><a href="log_out.php">Salir</a></li>
        </ul>
    </nav>

    <script>
        const btnMenu = document.getElementById('btn-menu');
        const menu = document.getElementById('menu-lateral');
        const boton_del_menu = document.getElementById('btn-menu');
        btnMenu.addEventListener('click', () => {
            menu.classList.toggle('abierto');
            boton_del_menu.classList.toggle('abierto');
        });
    </script>

    <div class="selecion">
        <div class="seleccion-div">
            <a href="FrmComida.php" class="Opcion">
                Comida
            </a>
            <a href="FrmBebidas.php" class="Opcion">
                Bebidas
            </a>
        </div>
    </div>

    <div class="agregar-comida-form">
        <h2>Agregar Nueva Bebida</h2>
        <?php if (isset($mensaje)) : ?>
            <p class="mensaje"><?= $mensaje ?></p>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="agregar_comida" value="1">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" min="0" step="0.01" required>

            <label for="imagen">URL de la Imagen:</label>
            <input type="text" id="imagen" name="imagen">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"></textarea>

            <button type="submit">Agregar Comida</button>
        </form>
    </div>

    <h1>Bebidas</h1>

    <div class="menu-grid">
        <?php if (!empty($menu)) : ?>
            <?php foreach ($menu as $item) : ?>
                <div class="card">
                    <img src="<?= $item['imagen'] ?>" alt="<?= $item['nombre'] ?>">
                    <h3><?= $item['nombre'] ?></h3>
                    <p><?= $item['descripcion'] ?></p>
                    <span>Lps <?= $item['precio'] ?></span>
                    <div class="card-acciones">
                        <button class="modificar">Modificar</button>
                        <button onclick="window.location.href='?eliminar=<?= $item['id'] ?>'">Eliminar</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No hay elementos en el menú.</p>
        <?php endif; ?>
    </div>

    <footer class="foot">
        Derechos reservados &copy; Duodécimo Informática
    </footer>
</body>

</html>