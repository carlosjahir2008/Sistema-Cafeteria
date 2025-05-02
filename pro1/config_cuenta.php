<!DOCTYPE html>
<html lang="es">



<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
if ($_SESSION['nivel'] > 3) {
    header("Location: login.php");
    exit();
}

$identidad = $_SESSION['identidad'];
$usuario = $_SESSION['usuario'];
$nombre = $_SESSION['nombre'];

$nivel = match ($_SESSION['nivel']) {
    1 => "Administrador",
    2 => "Encargado",
    default => "Usuario"
};
?>


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Configuración de Cuenta</title>
    <style>
        body {
            background-color: #e8f5f0;
            font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            padding-top: 60px;
        }

        .account-container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffffd9;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(1, 76, 47, 0.2);
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #014c2f;
            border-bottom: 2px solid #13a35b55;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            color: #014c2f;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 15px;
            border: 1px solid #a0d3bf;
            border-radius: 8px;
            background-color: #f2fcf9;
        }

        .form-group input[readonly] {
            background-color: #e2f3ee;
        }

        .foto {
            display: flex;
            justify-content: center;
            border-bottom: 1px solid #c4e5d9;
            margin-bottom: 30px;
            padding-bottom: 30px;
        }

        .foto img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background-color: #d2f0e3;
            border: 2px solid #86c9a9;
            object-fit: cover;
        }

        .botones {
            width: 100%;
            padding: 10px;
        }

        .botones button {
            margin-top: 20px;
            height: 45px;
            width: 100%;
            background-color: #014c2f;
            border-radius: 30px;
            color: #fffacf;
            font-weight: 600;
            font-size: 16px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .botones button:hover {
            background-color: #013a26;
            cursor: pointer;
        }

        .encabezado {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            padding: 15px 20px;
            background-color: #014c2f;
            color: #fffacf;
            font-weight: bold;
            font-size: 18px;
            z-index: 1001;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .encabezado button {
            background: none;
            border: none;
            color: #fffacf;
            font-size: 18px;
            cursor: pointer;
        }

        .menu {
            position: fixed;
            top: 0;
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
    </style>
</head>


<body>
    <header class="encabezado">
        <button id="btn-menu">☰ Menu</button>
    </header>

    <nav id="menu-lateral" class="menu">
        <ul>
            <?php
            if ($_SESSION['nivel'] < 3) : ?>
                <li><a href="index_encargado.php">Incio encargado</a></li>
            <?php endif; ?>

            <li><a href="index_comida.php">Inicio</a></li>
            <li><a href="config_cuenta.php">Cuenta</a></li>
            <li><a href="#">Configuracion</a></li>

            <?php
            if ($_SESSION['nivel'] < 3) : ?>
                <li><a href="#">Estadisticas</a></li>
            <?php endif; ?>


            <li><a href="log_out.php">Salir</a></li>
        </ul>
    </nav>

    <div class="account-container">
        <h1>Configuración de Cuenta</h1>

        <div class="foto">
            <img src="./iconos/usuario_pred.png" alt="foto-cuenta" />
        </div>

        <div class="form-group">
            <label for="nombre">identidad</label>
            <input type="text" id="nombre" value="<?= htmlspecialchars($identidad) ?>" readonly />
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" value="<?= htmlspecialchars($nombre) ?>" readonly />
        </div>

        <div class="form-group">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" value="<?= htmlspecialchars($usuario) ?>" readonly />
        </div>

        <div class="form-group">
            <label for="nivel">Nivel</label>
            <input type="text" id="nivel" value="<?= htmlspecialchars($nivel) ?>" readonly />
        </div>

        <div class="form-group">
            <label for="contra">Contraseña</label>
            <input type="password" id="contra" value="***************" readonly />
        </div>

        <div class="botones">
            <button>Modificar</button>
        </div>
    </div>

    <script>
        const btnMenu = document.getElementById('btn-menu');
        const menu = document.getElementById('menu-lateral');
        btnMenu.addEventListener('click', () => {
            menu.classList.toggle('abierto');
        });
    </script>
</body>

</html>